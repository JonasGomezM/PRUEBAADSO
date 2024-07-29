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
        $sales = Sale::with('user')->get();
        return view('sales.index', compact('sales'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total' => 'required|numeric|min:0',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart) return redirect()->route('carts.index');

        $total = $validatedData['total'];

        $sale = Sale::create([
            'user_id' => $validatedData['user_id'],
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
                return redirect()->route('carts.index')->with('error', 'Uno o más productos en el carrito son inválidos.');
            }
        }

        $cart->delete(); // Vaciar carrito
        return redirect()->route('sales.index')->with('success', 'La compra fue exitosa.');
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

        $cart->delete(); // Vaciar carrito

        return response()->json(['success' => 'Compra realizada con éxito']);
    }
}
