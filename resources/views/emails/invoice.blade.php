<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
</head>
<body>
    <h1>Factura de Compra</h1>
    <p>Usuario: {{ $sale->user->name }}</p>
    <p>Total: {{ $sale->total }}</p>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
