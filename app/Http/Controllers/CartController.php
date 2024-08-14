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
        $items = $cart ? $cart->items : collect([]);

        $total = $items->sum(function ($item) {
            return $item->product ? $item->quantity * $item->product->price : 0;
        });

        return response()->json(['items' => $items, 'total' => $total]);
    }

    public function add(Request $request, $productId)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $product = Product::find($productId);

        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $productId],
            ['quantity' => $request->quantity]
        );

        return response()->json(['message' => 'Producto agregado al carrito exitosamente.', 'item' => $cartItem]);
    }

    public function remove($itemId)
    {
        $cartItem = CartItem::find($itemId);
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Producto eliminado del carrito exitosamente.']);
        }

        return response()->json(['message' => 'Producto no encontrado.'], 404);
    }

    public function updateQuantities(Request $request)
    {
        $quantities = $request->input('quantities', []);
        $total = 0;

        foreach ($quantities as $itemId => $quantity) {
            $cartItem = CartItem::find($itemId);
            if ($cartItem) {
                $cartItem->quantity = (int) $quantity;
                $cartItem->save();

                $total += $cartItem->product->price * $cartItem->quantity;
            }
        }

        return response()->json(['message' => 'Quantidades actualizadas correctamente.', 'total' => $total]);
    }
}
