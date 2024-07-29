@extends('layouts.app')

@section('title', 'Página Principal')

@section('content')
    <div class="container-fluid px-0">
        <!-- Mensaje de Bienvenida -->
        <div class="text-center my-4">
            <h1 class="display-3 font-weight-bold">Bienvenido a la Página Principal</h1>
            <p class="lead text-muted">Explora nuestros productos y ofertas.</p>
        </div>

        <!-- Carrusel de Imágenes -->
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
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

        <!-- Inputs de Búsqueda -->
        <div class="row my-4">
            <div class="col-md-12">
                <input type="text" class="form-control form-control-lg shadow-sm" placeholder="Buscar productos por nombre...">
            </div>
        </div>

        <div class="row">
            <!-- Sección de Categorías -->
            <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold mb-3">Categorías</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Perros</li>
                    <li class="list-group-item">Gatos</li>
                    <li class="list-group-item">Ropa</li>
                </ul>
            </div>

            <!-- Sección Principal -->
            <div class="col-md-9">
                <!-- Mostrar Productos en Oferta Solo Si Existen -->
                @if($offerProducts->count())
                    <div class="mt-5">
                        <h2 class="font-weight-bold mb-4">Productos en Oferta</h2>
                        <div id="offerProductsCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($offerProducts->chunk(3) as $chunk)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="row">
                                            @foreach($chunk as $product)
                                                <div class="col-md-4 mb-4">
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
                            <div class="col-md-4 mb-4">
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
    </div>

    <style>
        /* Estilos del Carrusel */
        .carousel {
            width: 100vw;
            max-width: 100%;
            height: 60vh;
            overflow: hidden;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            top: 50%;
            transform: translateY(-50%);
        }

        .carousel-control-prev {
            left: 0;
        }

        .carousel-control-next {
            right: 0;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: transparent;
            border: none;
        }

        .carousel-control-prev-icon::after,
        .carousel-control-next-icon::after {
            font-size: 2rem;
            color: #333;
        }

        /* Estilos de las Tarjetas */
        .card {
            border: none;
            border-radius: 0.5rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .card-img-top {
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 1rem;
        }

        /* Estilos de los Botones */
        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #117a8b;
        }
    </style>
@endsection
