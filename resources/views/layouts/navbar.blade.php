<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <a class="nav-link" href="{{ route('contacts') }}">Contactos</a>
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
