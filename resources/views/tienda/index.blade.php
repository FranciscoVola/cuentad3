@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tienda Oficial</h1>

    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-danger">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                        <strong class="text-warning">${{ number_format($producto->precio, 2, ',', '.') }}</strong>
                        <a href="{{ route('producto.detalle', $producto->id) }}" class="btn btn-outline-light btn-sm mt-2">Ver más</a>

                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos disponibles en este momento.</p>
        @endforelse
    </div>
@endsection
