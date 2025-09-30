@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="mb-4">¿Estás seguro que querés eliminar la noticia <strong>{{ $noticia->titulo }}</strong>?</h2>

    <div class="mb-4">
        @if ($noticia->imagen)
            <img src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de {{ $noticia->titulo }}" class="img-thumbnail" style="max-width: 250px;">
        @endif
    </div>

    <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Sí, eliminar</button>
    </form>

    <a href="{{ route('noticias.index') }}" class="btn btn-secondary ms-2">{{ __('Cancel') }}ar</a>
</div>
@endsection
