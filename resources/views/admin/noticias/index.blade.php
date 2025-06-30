@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Listado de Noticias</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('noticias.create') }}" class="btn btn-primary mb-3">Agregar nueva noticia</a>

    <div class="row">
        @forelse($noticias as $noticia)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($noticia->imagen)
                        <img src="{{ asset('storage/' . $noticia->imagen) }}" class="card-img-top" alt="Imagen de la noticia" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $noticia->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($noticia->contenido, 100) }}</p>
                        <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay noticias cargadas.</p>
        @endforelse
    </div>
@endsection
