<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Obtener todos los productos
        return view('main', compact('products')); // Pasar productos a la vista principal
    }
}
