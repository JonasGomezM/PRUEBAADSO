@extends('layouts.app')

@section('title', 'Página Principal')

@section('content')
    <div class="container">
        <!-- Inputs de Búsqueda -->
        <div class="row mb-4">
            <div class="col-md-12">
                <input type="text" class="form-control" placeholder="Buscar productos por nombre...">
            </div>
        </div>
        <!-- Carrusel de las Imágenes -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/slide1.jpg') }}" alt="Primera diapositiva">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/slide2.jpg') }}" alt="Segunda diapositiva">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/slide3.jpg') }}" alt="Tercera diapositiva">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
        <h1 class="text-center">Bienvenido a la Página Principal</h1>
        <p class="text-center">Explora nuestros productos y ofertas.</p>

        <div class="row">
            <!-- Sección de Categorías -->
            <div class="col-md-3">
                <h4>Categorías</h4>
                <ul class="list-group">
                    <li class="list-group-item">Categoría 1</li>
                    <li class="list-group-item">Categoría 2</li>
                    <li class="list-group-item">Categoría 3</li>
                </ul>
            </div>

            <!-- Sección Principal -->
            <div class="col-md-9">

                <!-- Mostrar Productos en Oferta Solo Si Existen -->
                @if($offerProducts->count())
                    <div class="mt-5">
                        <h2>Productos en Oferta</h2>
                        <div class="position-relative">
                            <div id="offerProductsCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($offerProducts->chunk(3) as $chunk)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach($chunk as $product)
                                                    <div class="col-md-4 mb-3">
                                                        <div class="card">
                                                            @if($product->image_url)
                                                                <img class="card-img-top" src="{{ $product->image_url }}" alt="Imagen del Producto" style="height: 150px; object-fit: cover;">
                                                            @else
                                                                <img class="card-img-top" src="{{ asset('images/product-placeholder.png') }}" alt="Imagen del Producto">
                                                            @endif
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                                <p class="card-text">{{ $product->description }}</p>
                                                                <p class="card-text"><strong>Precio:</strong> ${{ $product->price }}</p>
                                                                <form method="POST" action="{{ route('carts.add', $product->id) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="quantity" value="1">
                                                                    <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#offerProductsCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#offerProductsCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
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
                    <h2>Productos Recientes</h2>
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    @if($product->image_url)
                                        <img class="card-img-top" src="{{ $product->image_url }}" alt="Imagen del Producto" style="height: 150px; object-fit: cover;">
                                    @else
                                        <img class="card-img-top" src="{{ asset('images/product-placeholder.png') }}" alt="Imagen del Producto">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p class="card-text"><strong>Precio:</strong> ${{ $product->price }}</p>
                                        <form method="POST" action="{{ route('carts.add', $product->id) }}">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-success">Agregar al Carrito</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            top: 50%;
            transform: translateY(-50%);
        }

        .carousel-control-prev {
            left: -5%;
        }

        .carousel-control-next {
            right: -5%;
        }

        .carousel-inner {
            padding: 0 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: transparent;
        }

        .carousel-control-prev-icon::after,
        .carousel-control-next-icon::after {
            content: '‹';
            font-size: 2rem;
            color: black;
        }

        .carousel-control-next-icon::after {
            content: '›';
        }
    </style>
@endsection
