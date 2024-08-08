<?php

namespace App\Http\Controllers;

use App\Mail\SaleNotificationMailable;
use App\Models\Cart;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->get();
        return view('admin.facturas', compact('sales'));
    }

    public function store(Request $request)
{
    $cart = Cart::where('user_id', Auth::id())->first();
    if (!$cart) {
        return response()->json(['success' => false, 'message' => 'Tu carrito está vacío.']);
    }

    $total = $cart->items->sum(function($item) {
        return $item->product->price * $item->quantity;
    });

    $userId = Auth::id();

    $sale = Sale::create([
        'user_id' => $userId,
        'total' => $total,
    ]);

    foreach ($cart->items as $item) {
        if ($item->product) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Uno o más productos en el carrito son inválidos.']);
        }
    }

    Mail::to(Auth::user()->email)->send(new SaleNotificationMailable($sale));

    $cart->delete();

    return response()->json(['success' => true, 'message' => 'La compra fue exitosa.']);
}


    public function ajaxStore(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart) return response()->json(['error' => 'Carrito vacío o inválido'], 400);

        $total = $request->input('total');
        $userId = Auth::id();

        $sale = Sale::create([
            'user_id' => $userId,
            'total' => $total,
        ]);

        foreach ($cart->items as $item) {
            if ($item->product) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            } else {
                return response()->json(['error' => 'Uno o más productos en el carrito son inválidos'], 400);
            }
        }

        // Enviar correo electrónico con la factura
        Mail::to(Auth::user()->email)->send(new SaleNotificationMailable($sale));

        // Vaciar carrito
        $cart->delete();

        return response()->json(['success' => 'Compra realizada con éxito']);
    }
}
