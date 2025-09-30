@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Gestión de Entradas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="mb-3">Entradas cargadas</h2>

    <a href="{{ route('entradas-admin.create') }}" class="btn btn-success mb-3">Agregar nueva entrada</a>

    <div class="row">
        @forelse($entradas as $entrada)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">

                    @if($entrada->imagen)
                        <img src="{{ asset('storage/' . $entrada->imagen) }}" 
                             class="card-img-top" 
                             alt="Imagen del evento" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             class="card-img-top" 
                             alt="Imagen por defecto" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">{{ $entrada->evento }}</h3>
                        <p class="card-text mb-1"><strong>Lugar:</strong> {{ $entrada->lugar ?? '—' }}</p>
                        <p class="card-text mb-1"><strong>Fecha:</strong> {{ $entrada->fecha ?? '—' }}</p>
                        <p class="card-text mb-1"><strong>Hora:</strong> {{ $entrada->hora ?? '—' }}</p>
                        <p class="card-text mb-1"><strong>Código:</strong> {{ $entrada->codigo }}</p>
                        <p class="card-text mb-3"><strong>Comprador:</strong> {{ $entrada->usuario->name ?? 'Sin usuario' }}</p>

                        <div class="mt-auto">
                            <a href="{{ route('entradas-admin.edit', $entrada->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                            <a href="{{ route('entradas-admin.confirmDelete', $entrada->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay entradas cargadas todavía.</p>
        @endforelse
    </div>
@endsection
