@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Agregar nueva noticia</h1>

    <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título *</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo') }}" required>
            @error('titulo')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido *</label>
            <textarea name="contenido" id="contenido" class="form-control" rows="5" required>{{ old('contenido') }}</textarea>
            @error('contenido')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" readonly>
            @error('fecha')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
            @error('imagen')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar noticia</button>
       <a href="{{ route('noticias.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
@endsection
