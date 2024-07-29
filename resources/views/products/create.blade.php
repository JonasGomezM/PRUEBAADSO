@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Agregar Nuevo Producto</h1>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" class="form-control" required>
                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Categoría</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Seleccionar categoría</option>
                            <option value="perros">Perros</option>
                            <option value="gatos">Gatos</option>
                            <option value="ropa">Ropa</option>
                        </select>
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
