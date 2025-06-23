@extends('layouts.app')

@section('content')

<div class="banner-home mb-5"></div>


<hr>

<h2 class="mb-4">Últimas Noticias</h2>
<div class="row">
    @foreach($noticias as $noticia)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $noticia->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($noticia->contenido, 100) }}</p>
                    <a href="{{ route('noticia.detalle', $noticia->id) }}" class="btn btn-outline-danger btn-sm">Ver más</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<hr>

<h2 class="mb-4">Productos Destacados</h2>
<div class="row">
    @foreach($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">{{ Str::limit($producto->descripcion, 80) }}</p>
                    <strong class="text-danger">${{ number_format($producto->precio, 2, ',', '.') }}</strong>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
