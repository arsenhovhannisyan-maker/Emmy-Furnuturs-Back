<?php

namespace App\Http\Controllers\Web\Basket;

use App\Http\Controllers\Dashboard\BaseController;
use App\Models\Basket\Basket;
use App\Models\BasketItem\BasketItem;
use App\Models\Product\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends BaseController
{
    public function show()
    {
        if (!Auth::check()) {
            session()->put('url.intended', url()->current());
            return redirect()->route('login')
                ->with('error', __('messages.please_login_to_view_cart'));
        }

        $basket = Basket::with('items.product', 'items.productSize')->firstOrCreate(['user_id' => Auth::id()]);

        return view('web.cart', [
            'basket' => $basket,
            'items' => $basket->items,
            'total' => $basket->items->sum(fn($item) => $item->line_total)
        ]);
    }

    public function add(Request $request): RedirectResponse|JsonResponse
    {
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => __('messages.please_login_to_view_cart')], 401);
            }
            return redirect()->route('login')->with('error', __('messages.please_login_to_view_cart'));
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:1000',
            'size_id' => 'nullable|integer|exists:product_sizes,id',
        ]);

        $product = Product::with('sizes')->findOrFail($request->product_id);

        if ($product->sizes->isNotEmpty()) {
            if (!$request->size_id || !$product->sizes->contains('id', (int) $request->size_id)) {
                $message = __('messages.please_select_size');
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $message], 422);
                }
                return redirect()->back()->with('error', $message);
            }
        }

        $basket = Basket::firstOrCreate(['user_id' => Auth::id()]);
        $sizeId = $request->size_id ?: null;

        $basketItem = BasketItem::where('basket_id', $basket->id)
            ->where('product_id', $request->product_id)
            ->where('product_size_id', $sizeId)
            ->first();

        if ($basketItem) {
            $basketItem->quantity += $request->quantity ?? 1;
            $basketItem->save();
        } else {
            $basketItem = BasketItem::create([
                'basket_id' => $basket->id,
                'product_id' => $request->product_id,
                'product_size_id' => $sizeId,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            $cartCount = BasketItem::where('basket_id', $basket->id)->sum('quantity');
            return response()->json([
                'success' => true,
                'message' => __('messages.product_added_to_cart'),
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->back()->with('success', __('messages.product_added_to_cart'));
    }

    public function updateQuantity(Request $request): RedirectResponse|JsonResponse
    {
        if (!Auth::check()) {
            return $request->wantsJson() || $request->ajax()
                ? response()->json(['success' => false, 'message' => __('messages.please_login')], 401)
                : redirect()->route('login')->with('error', __('messages.please_login'));
        }

        $request->validate([
            'item_id' => 'required|exists:basket_items,id',
            'quantity' => 'required|integer|min:1|max:1000'
        ]);

        $basketItem = BasketItem::with('product', 'productSize')
            ->where('id', $request->item_id)
            ->whereHas('basket', fn($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();

        $basketItem->quantity = $request->quantity;
        $basketItem->save();

        if ($request->wantsJson() || $request->ajax()) {
            $basket = Basket::with('items.product', 'items.productSize')->firstOrCreate(['user_id' => Auth::id()]);
            $cartTotal = $basket->items->sum(fn($i) => $i->line_total);
            $cartCount = $basket->items->sum('quantity');
            return response()->json([
                'success' => true,
                'line_total' => $basketItem->line_total,
                'cart_total' => $cartTotal,
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->back()->with('success', 'Количество обновлено');
    }

    public function remove($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', __('messages.please_login'));
        }

        $basketItem = BasketItem::where('id', $id)
            ->whereHas('basket', fn($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();
        $basketItem->delete();

        return redirect()->back()->with('success', 'Товар удален из корзины');
    }

    public function getData()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0, 'total' => 0, 'items' => []]);
        }

        $user = Auth::user();

        $basketItems = $user->basket?->items()->with('product.photo1', 'productSize')->get() ?? collect();

        $total = $basketItems->sum(fn($item) => $item->line_total);

        return response()->json([
            'count' => $basketItems->sum('quantity'),
            'total' => $total,
            'items' => $basketItems->map(fn($item) => [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'name' => $item->product->name,
                'size' => $item->productSize?->size,
                'price' => $item->unit_price,
                'quantity' => $item->quantity,
                'image' => $item->product->photo1,
            ]),
        ]);
    }
}
