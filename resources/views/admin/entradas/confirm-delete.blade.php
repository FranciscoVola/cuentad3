@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-danger">Confirmar eliminación</h1>

    <div class="alert alert-warning">
        ¿Estás seguro de que querés eliminar esta entrada? Esta acción no se puede deshacer.
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $entrada->evento }}</h5>
            <p class="card-text">Código: <strong>{{ $entrada->codigo }}</strong></p>
            <p class="card-text">Comprador: {{ $entrada->usuario->name ?? 'Sin usuario' }}</p>
            @if ($entrada->imagen)
                <img src="{{ asset('storage/' . $entrada->imagen) }}" alt="Imagen entrada" class="img-fluid" style="max-width: 300px;">
            @endif
        </div>
    </div>

    <form action="{{ route('entradas-admin.destroy', $entrada->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
        <a href="{{ route('entradas-admin.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
