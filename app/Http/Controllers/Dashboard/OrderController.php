<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Order\IOrderRepository;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Requests\Order\OrderSearchRequest;
use App\Mail\OrderStatusMail;
use App\Models\Basket\Basket;
use App\Models\Order\Order;
use App\Models\Order\OrderSearch;
use App\Models\OrderItems\OrderItem;
use App\Models\User\User;
use App\Services\Order\OrderService;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends BaseController
{
    public function __construct(
        OrderService $service,
        IOrderRepository $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(): View
    {
        return $this->dashboardView('order.index');
    }

    public function getListData(OrderSearchRequest $request): array
    {
        $searcher = new OrderSearch($request->validated());

        return [
            'recordsTotal' => $searcher->totalCount(),
            'recordsFiltered' => $searcher->filteredCount(),
            'data' => $searcher->search(),
        ];
    }

    public function create(): View
    {
        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->get();

        return $this->dashboardView(
            view: 'order.form',
            vars: [
                'order' => new Order(),
                'customers' => $customers,
                'viewMode' => 'add'
            ]
        );
    }

    public function store(OrderRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            if (auth()->check()) {
                $data['user_id'] = auth()->id();
            }

            $order = $this->repository->create($data);

            return response()->json([
                'success' => true,
                'message' => 'Заказ успешно создан!',
                'redirect_url' => route('dashboard.orders.index')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при создании заказа: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Order $order): View
    {
        return $this->dashboardView(
            view: 'order.form',
            vars: [
                'order' => $order,
                'viewMode' => 'show'
            ]
        );
    }

    public function edit(Order $order): View
    {
        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->get();

        return $this->dashboardView(
            view: 'order.form',
            vars: [
                'order' => $order,
                'customers' => $customers,
                'viewMode' => 'edit'
            ]
        );
    }

    public function update(OrderRequest $request, Order $order): JsonResponse
    {
        try {
            $this->repository->update($order->id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Заказ успешно обновлен!',
                'redirect_url' => route('dashboard.orders.index')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении заказа: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Order $order): JsonResponse
    {
        try {
            $this->repository->destroy($order->id);

            return response()->json([
                'success' => true,
                'message' => 'Заказ успешно удален!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении заказа: ' . $e->getMessage()
            ], 500);
        }
    }

    public function indexes(): View
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('web.orders.index', compact('orders'));
    }

    public function shows($id): View
    {
        $order = Order::with('items.product', 'items.productSize')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('web.orders.show', compact('order'));
    }

    public function checkoutPage(): RedirectResponse|View
    {
        $basket = Basket::with('items.product', 'items.productSize')->where('user_id', Auth::id())->first();

        if (!$basket || $basket->items->isEmpty()) {
            return redirect()->route('web.cart')->with('error', __('messages.cart_empty'));
        }

        $items = $basket->items;

        $subtotal = $items->sum(fn($item) => $item->line_total);
        $shippingCost = 0.00;
        $tax = 0.00;
        $total = $subtotal + $shippingCost + $tax;

        return view('web.checkout', [
            'basket' => $basket,
            'items' => $items,
            'subtotal' => $subtotal,
            'shippingCost' => $shippingCost,
            'tax' => $tax,
            'total' => $total,
            'user' => Auth::user(),
        ]);
    }

    public function checkout(Request $request): JsonResponse
    {
        $user = Auth::user();
        $basket = Basket::with('items.product', 'items.productSize')->where('user_id', $user->id)->first();

        if (!$basket || $basket->items->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => __('messages.cart_empty')
            ], 400);
        }

        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'shipping_first_name' => 'required|string|max:255',
                'shipping_last_name' => 'required|string|max:255',
                'shipping_address' => 'required|string|max:500',
                'shipping_city' => 'required|string|max:255',
                'shipping_email' => 'required|email|max:255',
                'shipping_phone' => 'required|string|max:20',
                'shipping_company' => 'nullable|string|max:255',
                'notes' => 'nullable|string|max:1000',
                'payment_method' => 'required|string|in:bank_transfer,cash',
            ]);

            // Calculate prices from the current basket state (never trust client-submitted totals)
            $subtotal = $basket->items->sum(fn($item) => $item->line_total);
            $shippingCost = 0.00;
            $tax = 0.00;
            $total = $subtotal + $shippingCost + $tax;

            // Create order
            $orderData = array_merge($validated, [
                'user_id' => $user->id,
                'total' => $total,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping_cost' => $shippingCost,
                'status' => \App\Models\Order\Enums\OrderStatus::Pending->value,
            ]);

            $order = $this->repository->create($orderData);

            // Create order items
            foreach ($basket->items as $basketItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $basketItem->product_id,
                    'product_size_id' => $basketItem->product_size_id,
                    'size_label' => $basketItem->productSize?->size,
                    'quantity' => $basketItem->quantity,
                    'price' => $basketItem->unit_price,
                    'total' => $basketItem->line_total,
                ]);
            }

            // Clear the basket
            $basket->items()->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('messages.order_created_successfully'),
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'redirect_url' => route('order.show', $order->id),
                'pdf_url' => route('order.pdf', $order->id),
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Order creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => __('messages.error_creating_order') . ': ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadPdf($id): Response
    {
        $order = Order::with('items.product', 'items.productSize', 'customer')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $pdf = Pdf::loadView('components.order.pdf.pdf', [
            'order' => $order,
            'customer' => $order->customer,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream("order-{$order->order_number}.pdf");
    }
    public function sendStatusEmail(Request $request): JsonResponse
    {
        try {
            $orderId = $request->input('order_id');

            $order = [
                'id' => $orderId,
                'name' => 'Арсен',
                'status' => 'Отправлен',
            ];

            $coupon = 'DISCOUNT2025';

            Mail::to('customer@gmail.com')->send(
                new OrderStatusMail($order, $coupon)
            );

            return response()->json([
                'success' => true,
                'message' => 'Email отправлен успешно!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при отправке email: ' . $e->getMessage()
            ], 500);
        }
    }

    public function exportPdf(Request $request): Response
    {
        $order = Order::with('items.product', 'items.productSize', 'customer')->findOrFail($request->order_id);
        $pdf = Pdf::loadView('components.order.pdf.pdf', [
            'order' => $order,
            'customer' => $order->customer,
        ])->setPaper('a4', 'portrait');

        return $pdf->download("order-{$order->order_number}.pdf");
    }
}
