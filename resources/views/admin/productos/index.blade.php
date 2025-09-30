@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Listado de Productos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="mb-3">Productos cargados</h2>

    <a href="{{ route('productos.create') }}" class="btn btn-success mb-3">Agregar nuevo producto</a>

    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">

                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                             class="card-img-top" 
                             alt="Imagen del producto" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             class="card-img-top" 
                             alt="Imagen por defecto" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">{{ $producto->nombre }}</h3>
                        <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                        <p class="card-text mb-1"><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                        <p class="card-text mb-3"><strong>Precio:</strong> ${{ number_format($producto->precio, 2, ',', '.') }}</p>

                        <div class="mt-auto">
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                            <a href="{{ route('productos.confirmDelete', $producto->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos cargados.</p>
        @endforelse
    </div>
@endsection
