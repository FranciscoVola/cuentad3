@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card bg-dark text-white p-4 shadow">
            <h1 class="mb-4 text-danger">Editar Noticia</h1>

            <form action="{{ route('noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" value="{{ $noticia->titulo }}" required>
                </div>

                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea name="contenido" class="form-control" rows="5" required>{{ $noticia->contenido }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ $noticia->fecha }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Imagen actual</label><br>
                    @if($noticia->imagen)
                        <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="Imagen actual" style="max-width: 300px;" class="mb-2">
                    @else
                        <p class="text-muted">No hay imagen cargada.</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Reemplazar imagen</label>
                    <input type="file" name="imagen" class="form-control">
                    <small class="text-danger">Solo se permiten imágenes (jpg, png, gif, svg). Máx 2MB.</small>
                </div>

                <button type="submit" class="btn btn-success">Actualizar noticia</button>
                <a href="{{ route('noticias.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
