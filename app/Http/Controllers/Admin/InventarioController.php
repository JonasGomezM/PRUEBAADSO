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

        // Contar la cantidad de productos
        $productCount = $products->count();

        // Contar la cantidad de productos en oferta
        $offerProductCount = $offerProducts->count();

        return response()->json([
            'products' => $products,
            'offerProducts' => $offerProducts,
            'productCount' => $productCount,
            'offerProductCount' => $offerProductCount,
        ]);
    }

    public function create()
    {
        return response()->json(['message' => 'Crear producto']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string|in:perros,gatos,ropa',
            'image_url' => 'nullable|url',
        ]);

        $product = Product::create($request->all());
        return response()->json(['message' => 'Producto agregado correctamente', 'product' => $product]);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json(['message' => 'Producto actualizado correctamente', 'product' => $product]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Producto eliminado correctamente']);
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

            return response()->json(['message' => 'Oferta desactivada.', 'product' => $product]);
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

            return response()->json(['message' => 'Producto agregado a la oferta.', 'product' => $product]);
        }
    }
}
