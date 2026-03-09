<?php

namespace App\Http\Controllers\Web\Basket;

use App\Http\Controllers\Dashboard\BaseController;
use App\Models\Basket\Basket;
use App\Models\BasketItem\BasketItem;
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

        $basket = Basket::with('items.product')->firstOrCreate(['user_id' => Auth::id()]);

        return view('web.cart', [
            'basket' => $basket,
            'items' => $basket->items,
            'total' => $basket->items->sum(fn($item) => $item->quantity * $item->product->price)
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
            'quantity' => 'nullable|integer|min:1'
        ]);

        $basket = Basket::firstOrCreate(['user_id' => Auth::id()]);

        $basketItem = BasketItem::where('basket_id', $basket->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($basketItem) {
            $basketItem->quantity += $request->quantity ?? 1;
            $basketItem->save();
        } else {
            BasketItem::create([
                'basket_id' => $basket->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ?? 1
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => __('messages.product_added_to_cart')]);
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

        $basketItem = BasketItem::with('product')->findOrFail($request->item_id);
        $basketItem->quantity = $request->quantity;
        $basketItem->save();

        if ($request->wantsJson() || $request->ajax()) {
            $lineTotal = $basketItem->quantity * $basketItem->product->price;
            $basket = Basket::with('items.product')->firstOrCreate(['user_id' => Auth::id()]);
            $cartTotal = $basket->items->sum(fn($i) => $i->quantity * $i->product->price);
            return response()->json([
                'success' => true,
                'line_total' => $lineTotal,
                'cart_total' => $cartTotal,
            ]);
        }

        return redirect()->back()->with('success', 'Количество обновлено');
    }

    public function remove($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', __('messages.please_login'));
        }

        $basketItem = BasketItem::findOrFail($id);
        $basketItem->delete();

        return redirect()->back()->with('success', 'Товар удален из корзины');
    }

    public function getData()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0, 'total' => 0, 'items' => []]);
        }

        $user = Auth::user();

        $basketItems = $user->basket?->items()->with('product')->get() ?? collect();

        $total = $basketItems->sum(fn($item) => $item->product->price * $item->quantity);

        return response()->json([
            'count' => $basketItems->count(),
            'total' => $total,
            'items' => $basketItems->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'image' => $item->product->photo1,
            ]),
        ]);
    }
}
