<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda de la solicitud
        $search = $request->input('search');

        // Si hay un término de búsqueda, filtrar los productos por nombre
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->get();
        
        // Obtener productos en oferta
        $offerProducts = Product::where('is_on_offer', true)->get();
        
        // Pasar ambos conjuntos de productos a la vista principal
        return view('main', compact('products', 'offerProducts'));
    }
}




// este controlador es de muetsra para visualizar el contador de prodcutos solo en esta vista
// para verlos en todas las rutas hay que hacer un controlador provider para visualizar todo
// namespace App\Http\Controllers;

// use App\Models\Product;
// use App\Models\Cart;
// use Illuminate\Support\Facades\Auth;

// class HomeController extends Controller
// {
//     public function index()
//     {
//         // Obtener todos los productos
//         $products = Product::all();
        
//         // Obtener productos en oferta
//         $offerProducts = Product::where('is_on_offer', true)->get();

//         // Obtener el conteo de productos en el carrito
//         $cartProductsCount = $this->getCartProductsCount();

//         // Pasar todos los datos a la vista principal
//         return view('main', compact('products', 'offerProducts', 'cartProductsCount'));
//     }

//     private function getCartProductsCount()
//     {
//         // Si el usuario está autenticado, obtener el carrito y contar los productos
//         if (Auth::check()) {
//             $cart = Cart::where('user_id', Auth::id())->first();
//             return $cart ? $cart->items->sum('quantity') : 0;
//         }

//         return 0; // Si no está autenticado, el conteo es 0
//     }
// }

