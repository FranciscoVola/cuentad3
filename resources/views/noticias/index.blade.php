@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Últimas noticias</h1>

    <div class="row">
        @foreach($noticias as $noticia)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $noticia->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($noticia->contenido, 100) }}</p>
                        <small class="text-danger">Fecha: {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</small>
                        <a href="{{ route('noticia.detalle', $noticia->id) }}" class="btn btn-outline-light btn-sm mt-2">Ver más</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
