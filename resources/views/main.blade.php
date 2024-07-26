@extends('layouts.app') <!-- Cambia esto si el archivo de layout tiene un nombre diferente -->

@section('title', 'Página Principal')

@section('content')
    <h1 class="text-center">Bienvenido a la Página Principal</h1>
    <p class="text-center">Explora nuestros productos y ofertas.</p>
    
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
    <!-- Mostrar Productos en Oferta Solo Si Existen -->
    @if($offerProducts->count())
        <div class="mt-5">
            <h2>Productos en Oferta</h2>
            <div class="row">
                @foreach($offerProducts as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images/product-placeholder.png') }}" alt="Imagen del Producto">
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
    @endif


    <!-- Mostrar Productos Recientes -->
    <div class="mt-5">
        <h2>Productos Recientes</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('images/product-placeholder.png') }}" alt="Imagen del Producto">
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
@endsection
