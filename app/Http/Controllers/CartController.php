<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $items = $cart ? $cart->items : [];
        return view('carts.index', compact('items'));
    }

    public function add(Request $request, $productId)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $product = Product::find($productId);

        CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $productId],
            ['quantity' => $request->quantity]
        );

        return redirect()->route('carts.index');
    }

    public function remove($itemId)
    {
        CartItem::find($itemId)->delete();
        return redirect()->route('carts.index');
    }
}
