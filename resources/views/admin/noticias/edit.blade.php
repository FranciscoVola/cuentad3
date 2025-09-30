@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Editar Noticia</h1>

    <form action="{{ route('noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título *</label>
            <input type="text" name="titulo" id="titulo" class="form-control"
                   value="{{ old('titulo', $noticia->titulo) }}" required>
            @error('titulo')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido *</label>
            <textarea name="contenido" id="contenido" class="form-control" rows="5" required>{{ old('contenido', $noticia->contenido) }}</textarea>
            @error('contenido')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control"
                   value="{{ old('fecha', $noticia->fecha) }}">
            @error('fecha')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen actual</label><br>
            @if($noticia->imagen)
                <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="Imagen actual"
                     class="img-fluid rounded border border-danger mb-2" style="max-width: 300px;">
            @else
                <p class="text-light">No hay imagen cargada.</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Reemplazar imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
            @error('imagen')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <small class="text-light">Solo se permiten imágenes (jpg, png, gif, svg). Máx 2MB.</small>
        </div>

        <button type="submit" class="btn btn-success">Actualizar noticia</button>
        <a href="{{ route('noticias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
