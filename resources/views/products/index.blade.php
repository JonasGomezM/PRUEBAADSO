@extends('layouts.app') <!-- Cambia esto si el archivo de layout tiene un nombre diferente -->

@section('title', 'Productos')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Productos</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Producto</a>

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
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                <form action="#" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Oferta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
