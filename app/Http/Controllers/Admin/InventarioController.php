<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\OfferProduct;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $products = Product::when($query, function ($queryBuilder, $query) {
            return $queryBuilder->where('name', 'like', "%{$query}%");
        })->get();

        $offerProducts = Product::where('is_on_offer', true)->get();

        return view('admin.inventario', compact('products', 'offerProducts'));
    }

    public function create()
    {
        return view('admin.createProduct');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string|in:perros,gatos,ropa',
            'image_url' => 'nullable|url', // Validación para la URL de la imagen
        ]);

        Product::create($request->all());
        return redirect()->route('admin.inventario')->with('success', 'Producto agregado correctamente.');
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
        return redirect()->route('admin.inventario');
    }


    public function offer(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->is_on_offer) {
            // Si el producto ya está en oferta, quítalo de la oferta
            $product->is_on_offer = false;
            $product->save();

            // Elimina el producto de la tabla OfferProduct si existe
            $offerProduct = $product->offerProduct;
            if ($offerProduct) {
                $offerProduct->delete();
            }

            return redirect()->route('products.index')->with('success', 'Oferta desactivada.');
        } else {
            // Si el producto no está en oferta, agrégalo a la oferta
            OfferProduct::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
            ]);

            $product->is_on_offer = true;
            $product->save();

            return redirect()->route('products.index')->with('success', 'Producto agregado a la oferta.');
        }
    }
}
