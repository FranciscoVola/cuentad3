@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Luchadores</h1>

    <h2 class="mb-3">Luchadores Agregados</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('luchadores.create') }}" class="btn btn-success mb-4">Agregar Luchador</a>

    <div class="row">
        @forelse ($luchadores as $luchador)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">

                    {{-- Imagen con fallback --}}
                    @if ($luchador->imagen)
                        <img src="{{ asset('storage/' . $luchador->imagen) }}" 
                             class="card-img-top" 
                             alt="Imagen de {{ $luchador->nombre }}" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             class="card-img-top" 
                             alt="Imagen por defecto" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h3 class="card-title">{{ $luchador->nombre }}</h3>
                        <p class="card-text">
                            <strong>Alias:</strong> {{ $luchador->alias ?? '—' }}<br>
                            <strong>Peso:</strong> {{ $luchador->peso ?? '—' }}<br>
                            <strong>Altura:</strong> {{ $luchador->altura ?? '—' }}<br>
                            <strong>Ciudad:</strong> {{ $luchador->ciudad_origen ?? '—' }}<br>
                        </p>
                        <p class="card-text">
                            <strong>Biografía:</strong><br>
                            {{ Str::limit($luchador->biografia, 80) }}
                        </p>
                        <a href="{{ route('luchadores.edit', $luchador->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('luchadores.confirmDelete', $luchador->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay luchadores cargados.</p>
        @endforelse
    </div>
</div>
@endsection
