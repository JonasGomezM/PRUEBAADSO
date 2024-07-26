@extends('layouts.app')

@section('title', 'Productos en Oferta')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Productos en Oferta</h1>
        <div class="row">
            @foreach($offerProducts as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('images/product-placeholder.png') }}" alt="Imagen del Producto">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Precio:</strong> ${{ $product->price }}</p>
                            <form method="POST" action="{{ route('carts.add', $product->product_id) }}">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-success">Comprar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
