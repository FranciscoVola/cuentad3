@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Luchador</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('luchadores.update', $luchador->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $luchador->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="alias" class="form-label">Alias</label>
            <input type="text" id="alias" name="alias" class="form-control" value="{{ $luchador->alias }}">
        </div>

        <div class="mb-3">
            <label for="peso" class="form-label">Peso</label>
            <input type="text" id="peso" name="peso" class="form-control" value="{{ $luchador->peso }}">
            <small class="text-light">El peso esta en Kilos.</small>
        </div>

        <div class="mb-3">
            <label for="altura" class="form-label">Altura</label>
            <input type="text" id="altura" name="altura" class="form-control" value="{{ $luchador->altura }}">
            <small class="text-light">La altura esta en Metros.</small>
        </div>

        <div class="mb-3">
            <label for="ciudad_origen" class="form-label">Ciudad de origen</label>
            <input type="text" id="ciudad_origen" name="ciudad_origen" class="form-control" value="{{ $luchador->ciudad_origen }}">
        </div>

        <div class="mb-3">
            <label for="biografia" class="form-label">Biografía</label>
            <textarea id="biografia" name="biografia" class="form-control" rows="4">{{ $luchador->biografia }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen actual</label><br>
            @if($luchador->imagen)
               <img src="{{ asset('storage/' . $luchador->imagen) }}" alt="Imagen actual"
                     class="img-fluid rounded border border-danger mb-2" style="max-width: 300px;">
            @else
                <p><em>No hay imagen cargada</em></p>
            @endif
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Cambiar imagen (opcional)</label>
            <input type="file" id="imagen" name="imagen" class="form-control">
            <small class="text-light">Solo se permiten imágenes jpeg, png, jpg, gif, svg, webp. Máx 2MB.</small>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('luchadores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
