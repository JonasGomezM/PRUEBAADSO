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
            @if (auth()->check() && auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.citas') }}">Citas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.facturas') }}">Facturas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.registro_usuario') }}">Registro usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.inventario') }}">Inventario</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appointments.create') }}">Citas Médicas</a>
                </li>
            @endif
            @if (auth()->check() && auth()->user()->role === 'user')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('carts.index') }}">
                        <i class="fas fa-shopping-cart {{ $cartProductsCount > 0 ? 'text-danger' : 'text-secondary' }}"></i>
                        @if($cartProductsCount > 0)
                            <span class="badge badge-danger">{{ $cartProductsCount }}</span>
                        @endif
                    </a>
                </li>
            @endif
            @if (Auth::check())
                <li class="nav-item user-button">
                    <a class="btn btn-secondary" href="#">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="btn btn btn-danger" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesion
                    </a>
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
        color: #FF5722;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 6h16M4 12h16M4 18h16'/%3E%3C/svg%3E");
    }

    .btn-secondary {
        background-color: #FF5722;
        border-color: #FF5722;
        color: #ffffff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #FF7043;
        border-color: #FF7043;
    }

    .btn-primary {
        background-color: #8A2BE2;
        border-color: #8A2BE2;
        color: #ffffff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #9B30FF;
        border-color: #9B30FF;
    }

    .btn-danger {
        background-color: #FF5722;
        border-color: #FF5722;
        color: #ffffff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #E64A19;
        border-color: #E64A19;
    }

    .badge-danger {
        background-color: #FF5722;
    }

    .user-button {
        margin-right: 10px;
    }
</style>
