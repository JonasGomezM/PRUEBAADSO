<!-- resources/views/main.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <!-- Agregar Bootstrap CSS para estilos básicos -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Opcional: Agregar tu propio CSS -->
    <style>
        .navbar-brand img {
            height: 40px;
        }
        .btn-info {
            margin: 5px;
        }
    </style>
</head>
<body>

<!-- Barra de Navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
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
        <a class="btn btn-info" href="{{ route('products.index') }}">Ver Productos</a>
        <a class="btn btn-info" href="{{ route('contacts') }}">Ver Contactos</a>
        <a class="btn btn-info" href="{{ route('appointments') }}">Ver Citas Médicas</a>
    </div>
</div>

<!-- Agregar Bootstrap JS y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
