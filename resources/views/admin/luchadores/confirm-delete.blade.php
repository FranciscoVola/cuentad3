@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="mb-4">¿Estás seguro que querés eliminar al luchador <strong>{{ $luchador->nombre }}</strong>?</h2>

    <div class="mb-4">
        @if ($luchador->imagen)
            <img src="{{ Storage::url($luchador->imagen) }}" alt="Imagen de {{ $luchador->nombre }}" class="img-thumbnail" style="max-width: 250px;">
        @endif
    </div>

    <form action="{{ route('luchadores.destroy', $luchador->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Sí, eliminar</button>
    </form>

    <a href="{{ route('luchadores.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
</div>
@endsection
