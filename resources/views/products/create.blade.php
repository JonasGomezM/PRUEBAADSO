@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Agregar Nuevo Producto</h1>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Campos existentes con placeholder en lugar de labels -->
                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre del Producto" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Descripción">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Precio" step="0.01" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Stock" value="{{ old('stock') }}" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select id="category" name="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="">Seleccionar categoría</option>
                            <option value="perros" {{ old('category') == 'perros' ? 'selected' : '' }}>Perros</option>
                            <option value="gatos" {{ old('category') == 'gatos' ? 'selected' : '' }}>Gatos</option>
                            <option value="ropa" {{ old('category') == 'ropa' ? 'selected' : '' }}>Ropa</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" id="image_url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" placeholder="URL de la Imagen" value="{{ old('image_url') }}">
                        @error('image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
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

<!-- Estilos personalizados -->
<style>
    .container {
        max-width: 1200px; /* Asegura que el contenedor no se expanda demasiado */
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .form-control {
        border-radius: 0.25rem;
        box-shadow: none;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 0.25rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 0.25rem;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>
