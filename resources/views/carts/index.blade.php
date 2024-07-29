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
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 100px; height: auto;">
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
            <!-- Botón para proceder a la compra -->
            <button id="buy-button" class="btn btn-primary mt-3">Comprar</button>
        @else
            <div class="alert alert-info" role="alert">
                Tu carrito está vacío.
            </div>
        @endif
    </div>

    <!-- Modal de Compra Exitosa -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Compra Exitosa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-check-circle fa-4x text-success"></i>
                    <p class="mt-3">¡Tu compra se realizó con éxito!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
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

            // Maneja el clic en el botón Comprar
            document.getElementById('buy-button').addEventListener('click', function() {
                const items = Array.from(document.querySelectorAll('#cart-items tr')).map(row => {
                    return {
                        id: row.getAttribute('data-id'),
                        quantity: parseInt(row.querySelector('.quantity-input').value)
                    };
                });

                const total = parseFloat(document.getElementById('total').textContent.replace('$', ''));

                fetch('/sale', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        items: items,
                        total: total,
                        user_id: {{ Auth::id() }}
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Mostrar el modal en lugar de la alerta
                    $('#successModal').modal('show');
                    // Recargar la página después de cerrar el modal
                    $('#successModal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                })
                .catch(error => {
                    alert('Error al procesar la compra.');
                    console.error('Error:', error);
                });
            });
        });
    </script>
@endsection
