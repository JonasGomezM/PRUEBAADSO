<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener todos los productos
        $products = Product::all();
        
        // Obtener productos en oferta
        $offerProducts = Product::where('is_on_offer', true)->get();
        
        // Pasar ambos conjuntos de productos a la vista principal
        return view('main', compact('products', 'offerProducts'));
    }
}
