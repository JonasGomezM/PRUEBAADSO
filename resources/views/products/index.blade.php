@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Productos</h1>

        
        <!-- Formulario de Búsqueda (sin funcionalidad aún) -->
        <form action="#" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Buscar productos..." />
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>
        
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Producto</a>
        <!-- Botón de Descargar Excel -->
        <a href="{{ route('products.export') }}" class="btn btn-success mb-3">
        <i class="fas fa-download"></i> Descargar
        </a>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('images/product-placeholder.png') }}" alt="Imagen del Producto">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Precio:</strong> ${{ $product->price }}</p>
                            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                            <p class="card-text"><strong>Categoría:</strong> {{ ucfirst($product->category) }}</p>
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                <form action="{{ route('products.offer', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn {{ $product->is_on_offer ? 'btn-danger' : 'btn-info' }}">
                                        {{ $product->is_on_offer ? 'Desactivar Oferta' : 'Activar Oferta' }}
                                    </button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
