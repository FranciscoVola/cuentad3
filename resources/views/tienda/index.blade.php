@extends('layouts.app')

@section('content')
    <h1 class="mb-4 titulo-seccion">Tienda Oficial</h1>

    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                             class="card-img-top" 
                             alt="Imagen de {{ $producto->nombre }}" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             class="card-img-top" 
                             alt="Imagen por defecto" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                        <strong class="text-danger mb-3">
                            ${{ number_format($producto->precio, 2, ',', '.') }}
                        </strong>

                        <div class="mt-auto">
                            <a href="{{ route('producto.detalle', $producto->id) }}" class="btn btn-outline-light btn-sm me-1">Ver más</a>
                            <a href="{{ route('carrito.agregar', $producto->id) }}" class="btn btn-success btn-sm">🛒 Agregar al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos disponibles en este momento.</p>
        @endforelse
    </div>
@endsection
