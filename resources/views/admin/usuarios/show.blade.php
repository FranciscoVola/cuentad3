
@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Detalle del Usuario</h1>

    <div class="card text-bg-dark mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $usuario->name }}</h4>
            <p class="card-text"><strong>Email:</strong> {{ $usuario->email }}</p>
            <p class="card-text"><strong>Rol:</strong> {{ $usuario->rol }}</p>
        </div>
    </div>

    <h2 class="mb-3">Noticias publicadas</h2>
    @forelse($usuario->noticias as $noticia)
        <div class="card mb-3 text-bg-dark">
            <div class="card-body">
                <h3 class="card-title">{{ $noticia->titulo }}</h3>
                <p class="card-text">{{ Str::limit($noticia->contenido, 100) }}</p>
                <p class="card-text"><small class="text-muted">Fecha: {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</small></p>
            </div>
        </div>
    @empty
        <p>Este usuario no ha publicado noticias.</p>
    @endforelse

    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-light mt-3">← Volver al listado</a>
@endsection
