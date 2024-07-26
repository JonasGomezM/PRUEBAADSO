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
                <tbody id="cart-items">
                    @foreach($items as $item)
                        @if($item->product)
                            <tr data-id="{{ $item->id }}" data-price="{{ $item->product->price }}">
                                <td>
                                    <!-- Imagen del producto -->
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>
                                    <!-- Selector de cantidad con tamaño reducido -->
                                    <input type="number" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm quantity-input" style="width: 80px;">
                                </td>
                                <td class="item-price">${{ number_format($item->product->price, 2) }}</td>
                                <td>
                                    <!-- Formulario para eliminar producto -->
                                    <form action="{{ route('carts.remove', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td><strong>Total:</strong></td>
                        <td><strong id="total">${{ number_format($total, 2) }}</strong></td>
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

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para calcular y actualizar el total
            const updateTotal = () => {
                let total = 0;
                document.querySelectorAll('#cart-items tr').forEach(row => {
                    const quantity = parseInt(row.querySelector('.quantity-input').value);
                    const price = parseFloat(row.getAttribute('data-price'));
                    total += quantity * price;
                });
                document.getElementById('total').textContent = `$${total.toFixed(2)}`;
            };

            // Actualiza el total cuando se cambia la cantidad
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    updateTotal();
                });
            });

            // Inicializa el total
            updateTotal();
        });
    </script>
@endsection
