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
        // Obtener el carrito del usuario autenticado
        $cart = Cart::where('user_id', Auth::id())->first();
        $items = $cart ? $cart->items : collect([]); // Asegúrate de que $items sea una colección

        // Calcular el total
        $total = $items->sum(function ($item) {
            return $item->product ? $item->quantity * $item->product->price : 0;
        });

        // Retornar la vista con los elementos y el total
        return view('carts.index', compact('items', 'total'));
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

    public function updateQuantities(Request $request)
    {
        $quantities = $request->input('quantities', []);

        $total = 0;

        foreach ($quantities as $itemId => $quantity) {
            $cartItem = CartItem::find($itemId);
            if ($cartItem) {
                $cartItem->quantity = (int) $quantity;
                $cartItem->save();

                // Calculate the total price
                $total += $cartItem->product->price * $cartItem->quantity;
            }
        }

        // Pass the total to the view
        return redirect()->route('carts.index')->with('success', 'Quantidades actualizadas correctamente.')
            ->with('total', $total);
    }
}
