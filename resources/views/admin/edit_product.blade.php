@extends('admin.index') <!-- Cambia esto si el archivo de layout tiene un nombre diferente -->

@section('title', 'Editar Producto')

@section('container')
    <div class="container mt-4">
        <h1 class="mb-4">Editar Producto</h1>
        <form  action="{{ route('admin.update_product', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Campo de categoría con opciones predefinidas -->
            <div class="form-group">
                <label for="category">Categoría</label>
                <select id="category" name="category" class="form-control">
                    <option value="perros" {{ old('category', $product->category) == 'perros' ? 'selected' : '' }}>Perros</option>
                    <option value="gatos" {{ old('category', $product->category) == 'gatos' ? 'selected' : '' }}>Gatos</option>
                    <option value="ropa" {{ old('category', $product->category) == 'ropa' ? 'selected' : '' }}>Ropa</option>
                </select>
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para URL de la imagen -->
            <div class="form-group">
                <label for="image_url">URL de la Imagen</label>
                <input type="text" id="image_url" name="image_url" class="form-control" value="{{ old('image_url', $product->image_url) }}">
                @error('image_url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
