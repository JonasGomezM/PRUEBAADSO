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
        
        <!-- Mensaje de Éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Lista de Productos en Filas Horizontales -->
        <div class="col-md-12">
            <!-- Mostrar Productos en Oferta Solo Si Existen -->
            @if($offerProducts->count())
                <div class="mt-5">
                    <h2 class="font-weight-bold mb-4">Productos en Oferta</h2>
                    <div id="offerProductsCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($offerProducts->chunk(4) as $chunk)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach($chunk as $product)
                                            <div class="col-md-3 mb-4">
                                                <div class="card border-light shadow-sm">
                                                    @if($product->image_url)
                                                        <img class="card-img-top" src="{{ $product->image_url }}" alt="Imagen del Producto" style="height: 150px; object-fit: cover;">
                                                    @else
                                                        <img class="card-img-top" src="{{ asset('images/product-placeholder.png') }}" alt="Imagen del Producto">
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $product->name }}</h5>
                                                        <p class="card-text">{{ $product->description }}</p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="card-text mb-0"><strong>Precio:</strong> ${{ $product->price }}</p>
                                                            <form method="POST" action="{{ route('carts.add', $product->id) }}">
                                                                @csrf
                                                                <input type="hidden" name="quantity" value="1">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#offerProductsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#offerProductsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                        <!-- Botón para ver más ofertas -->
                        <div class="text-center mt-3">
                            <a href="{{ route('offers.index') }}" class="btn btn-info">Ver Más Ofertas</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Mostrar Productos Recientes -->
            <div class="mt-5">
                <h2 class="font-weight-bold mb-4">Productos Recientes</h2>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card border-light shadow-sm">
                                @if($product->image_url)
                                    <img class="card-img-top" src="{{ $product->image_url }}" alt="Imagen del Producto" style="height: 150px; object-fit: cover;">
                                @else
                                    <img class="card-img-top" src="{{ asset('images/product-placeholder.png') }}" alt="Imagen del Producto">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-text mb-0"><strong>Precio:</strong> ${{ $product->price }}</p>
                                        <form method="POST" action="{{ route('carts.add', $product->id) }}">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
