<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OfferProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $offerProducts = Product::where('is_on_offer', true)->get(); 

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
            'category' => 'required|string|in:perros,gatos,ropa', // Validación para la categoría
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
            'category' => 'required|string|in:perros,gatos,ropa', // Validación para la categoría
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function offer(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (!$product->offerProduct) {
            OfferProduct::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
            ]);

            $product->is_on_offer = true;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Producto agregado a la oferta.');
    }
}
