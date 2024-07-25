<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OfferProduct;

class ProductController extends Controller
{
    public function index()
    {
        // Obtén todos los productos y productos en oferta
        $products = Product::all();
        $offerProducts = OfferProduct::all();

        // Devuelve la vista específica para productos
        return view('products.index', compact('products', 'offerProducts'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    $product->update($request->all());
    return redirect()->route('products.index')->with('success', 'Producto actualizado.');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }


    public function offer()
    {
        // Recupera todos los productos en oferta desde el modelo OfferProduct
        $offerProducts = OfferProduct::all();

        // Devuelve la vista 'offers.index' con los productos en oferta
        return view('offers.index', compact('offerProducts'));
    }
}
