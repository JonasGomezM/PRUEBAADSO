@extends('admin.index')

@section('container')
    <div class="container mt-5">
        <div class="d-flex align-items-center mb-4">
            <h1 class="mb-0">Lista de Productos</h1>

            <!-- Mostrar cantidad de productos y productos en oferta a la derecha del título -->
            <div class="d-flex ml-auto">
                <div class="card text-center bg-primary text-white mx-2" style="width: 50px; height: 50px; padding: 0;">
                    <div class="card-body p-1">
                        <i class="fas fa-box-open fa-xs mb-1"></i>
                        <p class="card-text mb-0" style="font-size: 0.75rem;">{{ $productCount }}</p>
                    </div>
                </div>
                <div class="card text-center bg-success text-white mx-2" style="width: 50px; height: 50px; padding: 0;">
                    <div class="card-body p-1">
                        <i class="fas fa-tags fa-xs mb-1"></i>
                        <p class="card-text mb-0" style="font-size: 0.75rem;">{{ $offerProductCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Búsqueda -->
        <div class="row mb-4">
            <div class="col-md-8 offset-md-2 text-center">
                <form action="{{ route('admin.inventario') }}" method="GET" class="form-inline justify-content-center">
                    <input type="text" name="query" class="form-control mr-2" placeholder="Buscar productos..."
                        value="{{ request('query') }}" style="width: 100%; max-width: 400px;">
                    <button type="submit" class="btn btn-primary ml-2">Buscar</button>
                </form>
            </div>
        </div>
        @if (auth()->check() && auth()->user()->role === 'admin')
            <div class="row mb-4">
                <div class="col-md-8 offset-md-2 d-flex justify-content-between">
                    <a href="{{ route('admin.create') }}" class="btn btn-primary" title="Agregar Nuevo Producto">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="{{ route('admin.export') }}" class="btn btn-success" title="Descargar Excel">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
        @endif
        <!-- Mensaje de Éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Lista de Productos en Filas Horizontales -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="row no-gutters">
                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                @if ($product->image_url)
                                    <img src="{{ $product->image_url }}" class="card-img" alt="{{ $product->name }}"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/100" class="card-img" alt="Imagen no disponible"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text">
                                        <strong>Precio:</strong> ${{ $product->price }}<br>
                                        <strong>Stock:</strong> {{ $product->stock }}<br>
                                        <strong>Categoria:</strong> {{ $product->category }}
                                    </p>
                                    <div class="d-flex mt-auto">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info mr-2" title="Ver Detalles">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        @if (auth()->check() && auth()->user()->role === 'admin')                                    
                                        <a href="{{ route('admin.edit_product', $product->id) }}" class="btn btn-warning mr-2" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mr-2" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.offer', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary" title="{{ $product->is_on_offer ? 'Eliminar de Oferta' : 'Agregar a Oferta' }}">
                                                <i class="fas {{ $product->is_on_offer ? 'fa-times' : 'fa-tag' }}"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
