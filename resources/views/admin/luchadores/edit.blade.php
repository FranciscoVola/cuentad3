@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Luchador</h1>

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
            <input type="text" name="nombre" class="form-control" value="{{ $luchador->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="alias" class="form-label">Alias</label>
            <input type="text" name="alias" class="form-control" value="{{ $luchador->alias }}">
        </div>

        <div class="mb-3">
            <label for="peso" class="form-label">Peso</label>
            <input type="text" name="peso" class="form-control" value="{{ $luchador->peso }}">
        </div>

        <div class="mb-3">
            <label for="altura" class="form-label">Altura</label>
            <input type="text" name="altura" class="form-control" value="{{ $luchador->altura }}">
        </div>

        <div class="mb-3">
            <label for="ciudad_origen" class="form-label">Ciudad de origen</label>
            <input type="text" name="ciudad_origen" class="form-control" value="{{ $luchador->ciudad_origen }}">
        </div>

        <div class="mb-3">
            <label for="biografia" class="form-label">Biografía</label>
            <textarea name="biografia" class="form-control" rows="4">{{ $luchador->biografia }}</textarea>
        </div>

        <!--
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen actual:</label><br>
            -->
            @if($luchador->imagen)
                <!-- <img src="{{ asset($luchador->imagen) }}" alt="Luchador" width="150" class="mb-2"><br>-->
            @else
               <!--  <em>No hay imagen subida</em><br>-->
            @endif
            <!--<label for="imagen" class="form-label">Cambiar imagen</label>
            <input type="file" name="imagen" class="form-control">-->
        </div>
        
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('luchadores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
