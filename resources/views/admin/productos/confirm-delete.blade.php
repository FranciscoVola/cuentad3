@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="mb-4">¿Estás seguro que querés eliminar el producto <strong>{{ $producto->nombre }}</strong>?</h2>

    <div class="mb-4">
        @if ($producto->imagen)
            <img src="{{ Storage::url($producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}" class="img-thumbnail" style="max-width: 250px;">
        @endif
    </div>

    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Sí, eliminar</button>
    </form>

    <a href="{{ route('productos.index') }}" class="btn btn-secondary ms-2">{{ __('Cancel') }}</a>
</div>
@endsection
