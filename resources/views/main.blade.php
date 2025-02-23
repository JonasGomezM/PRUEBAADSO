<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barra de Navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts') }}">Contactos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('appointments') }}">Citas Médicas</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="{{ route('login') }}">Iniciar Sesión</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Contenido Principal -->
<div class="container mt-5">
    <h1 class="text-center">Información Privilegiada</h1>
    <p class="text-center">Bienvenido a la página principal. Utiliza los botones a continuación para navegar a diferentes secciones.</p>
    <div class="text-center mt-4">
        <a class="btn btn-info mx-2" href="{{ route('products.index') }}">Ver Productos</a>
        <a class="btn btn-info mx-2" href="{{ route('contacts') }}">Ver Contactos</a>
        <a class="btn btn-info mx-2" href="{{ route('appointments') }}">Ver Citas Médicas</a>
    </div>

    <!-- Mostrar Productos en la Página Principal -->
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
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
