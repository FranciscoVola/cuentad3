@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-dark text-white shadow">
                <div class="card-body">
                    <h2 class="card-title text-danger">{{ $producto->nombre }}</h2>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <h4 class="text-warning">${{ number_format($producto->precio, 2, ',', '.') }}</h4>

                    <a href="{{ url('/tienda') }}" class="btn btn-secondary mt-3">← Volver a la tienda</a>
                </div>
            </div>
        </div>
    </div>
@endsection
