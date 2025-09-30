@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Listado de Noticias</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="mb-3">Noticias cargadas</h2>
    
    <a href="{{ route('noticias.create') }}" class="btn btn-success mb-3">Agregar nueva noticia</a>

    <div class="row">
        @forelse($noticias as $noticia)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">

                    @if($noticia->imagen)
                        <img src="{{ asset('storage/' . $noticia->imagen) }}" 
                             class="card-img-top" 
                             alt="Imagen de la noticia" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             class="card-img-top" 
                             alt="Imagen por defecto" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h3 class="card-title">{{ $noticia->titulo }}</h3>
                        <p class="card-text">{{ Str::limit($noticia->contenido, 100) }}</p>
                        <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('noticias.confirmDelete', $noticia->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay noticias cargadas.</p>
        @endforelse
    </div>
@endsection
