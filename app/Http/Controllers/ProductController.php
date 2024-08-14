<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $products = Product::when($query, function ($queryBuilder, $query) {
            return $queryBuilder->where('name', 'like', "%{$query}%");
        })->get();

        $offerProducts = Product::where('is_on_offer', true)->get();

        return response()->json(['products' => $products, 'offerProducts' => $offerProducts]);
    }

    public function showOffers()
    {
        $offerProducts = Product::where('is_on_offer', true)->get();

        return response()->json(['offerProducts' => $offerProducts]);
    }
}
