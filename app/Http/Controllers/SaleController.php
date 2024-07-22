<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::where('user_id', Auth::id())->get();
        return view('sales.index', compact('sales'));
    }

    public function store()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart) return redirect()->route('carts.index');

        $total = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $sale = Sale::create([
            'user_id' => Auth::id(),
            'total' => $total,
        ]);

        foreach ($cart->items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        $cart->delete(); // Vaciar carrito
        return redirect()->route('sales.index');
    }
}
