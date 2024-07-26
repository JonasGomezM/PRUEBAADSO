@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <div class="container">
        <h1 class="my-4">Carrito de Compras</h1>

        @if($items->isNotEmpty())
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        @if($item->product)
                            <tr>
                                <td>
                                    <!-- Imagen del producto -->
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>
                                    <!-- Selector de cantidad con tamaño reducido -->
                                    <input type="number" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 80px;">
                                </td>
                                <td>${{ $item->product->price }}</td>
                                <td>
                                    <!-- Botón para eliminar (sin lógica asociada) -->
                                    <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td><strong>Total:</strong></td>
                        <td><strong>${{ number_format($total, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>
            <!-- Botón para proceder a la compra (sin lógica asociada) -->
            <a href="#" class="btn btn-primary mt-3">Comprar</a>
        @else
            <div class="alert alert-info" role="alert">
                Tu carrito está vacío.
            </div>
        @endif
    </div>
@endsection