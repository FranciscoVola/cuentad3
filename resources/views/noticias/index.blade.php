@extends('layouts.app')

@section('content')
    <h1 class="mb-4 titulo-seccion">Ultimas Noticias</h1>

    <div class="row">
        @forelse($noticias as $noticia)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($noticia->imagen)
                        <img src="{{ asset('storage/' . $noticia->imagen) }}" class="card-img-top" alt="Imagen noticia" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $noticia->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($noticia->contenido, 100) }}</p>
                        <a href="{{ route('noticia.detalle', $noticia->id) }}" class="btn btn-outline-danger btn-sm">Ver más</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay noticias por mostrar.</p>
        @endforelse
    </div>
@endsection
