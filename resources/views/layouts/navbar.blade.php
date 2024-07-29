<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="{{ route('main') }}">
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
                <a class="nav-link" href="{{ route('offers.index') }}">Ofertas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('appointments.create') }}">Citas Médicas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('carts.index') }}">
                    <i class="fas fa-shopping-cart {{ $cartProductsCount > 0 ? 'text-danger' : 'text-secondary' }}"></i>
                    @if($cartProductsCount > 0)
                        <span class="badge badge-danger">{{ $cartProductsCount }}</span>
                    @endif
                </a>
            </li>
            @if (Auth::check())
                <li class="nav-item">
                    <a class="btn btn-secondary" href="#">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="btn btn-primary" href="{{ route('login') }}">Iniciar Sesión</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<style>
    .navbar {
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
        height: 40px;
    }

    .navbar-nav .nav-link {
        color: #333333;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #6A0DAD;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 6h16M4 12h16M4 18h16'/%3E%3C/svg%3E");
    }

    .btn-secondary {
        background-color: #6A0DAD;
        border-color: #6A0DAD;
        color: #ffffff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #8A2BE2;
        border-color: #8A2BE2;
    }

    .btn-primary {
        background-color: #6A0DAD;
        border-color: #6A0DAD;
        color: #ffffff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #8A2BE2;
        border-color: #8A2BE2;
    }

    .btn-danger {
        background-color: #d9534f;
        border-color: #d9534f;
        color: #ffffff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c9302c;
        border-color: #c9302c;
    }

    .badge-danger {
        background-color: #d9534f;
    }
</style>
