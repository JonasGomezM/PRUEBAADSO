@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Productos</h1>

        <!-- Formulario de Búsqueda -->
        <div class="row mb-4">
            <div class="col-md-8 offset-md-2 text-center">
                <form action="{{ route('products.index') }}" method="GET" class="form-inline justify-content-center">
                    <input type="text" name="query" class="form-control mr-2" placeholder="Buscar productos..."
                        value="{{ request('query') }}" style="width: 100%; max-width: 400px;">
                    <button type="submit" class="btn btn-primary ml-2">Buscar</button>
                </form>
            </div>
        </div>

        <!-- Botones para Crear Producto y Descargar Excel -->
        @if (auth()->check() && auth()->user()->role === 'admin')
            <div class="row mb-4">
                <div class="col-md-8 offset-md-2 d-flex justify-content-between">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Agregar Nuevo Producto</a>
                    <a href="{{ route('products.export') }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Descargar Excel
                    </a>
                </div>
            </div>
        @endif

        <!-- Mensaje de Éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Lista de Productos en Filas Horizontales -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($product->image_url)
                            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}"
                                style="width: 150px; height: 150px; object-fit: cover; margin: auto;">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagen no disponible"
                                style="width: 150px; height: 150px; object-fit: cover; margin: auto;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text d-flex justify-content-between">
                                    <span><strong>Precio:</strong> ${{ $product->price }}</span>
                                    <span><strong>Stock:</strong> {{ $product->stock }}</span>
                                <h6><strong>Categoria:</strong> {{ $product->category }}</h6>
                                </p>
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-block">Ver
                                    Detalles</a>
                                @if (auth()->check() && auth()->user()->role === 'admin')                                    
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-warning btn-block">Editar</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                                </form>
                                <form action="{{ route('products.offer', $product->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-block">
                                        {{ $product->is_on_offer ? 'Eliminar de Oferta' : 'Agregar a Oferta' }}
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
