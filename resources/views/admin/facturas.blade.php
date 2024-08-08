@extends('admin.index')

@section('title', 'Historial de Ventas')

@section('container')
    <div class="container">
        <h1 class="my-4">Tu Historial de Ventas</h1>

        <!-- Mensaje de Éxito -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mensaje de Error -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID de Venta</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Nombre del Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>${{ number_format($sale->total, 2) }}</td>
                        <td>{{ $sale->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $sale->user ? $sale->user->name : 'Usuario no encontrado' }}</td>
                        <td>
                            <!-- Icono de FontAwesome para generar factura -->
                            <button class="btn btn-primary">
                                <i class="fas fa-file-invoice"></i> Generar Factura
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
