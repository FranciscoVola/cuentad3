@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Luchador</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('luchadores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alias" class="form-label">Alias</label>
            <input type="text" name="alias" class="form-control">
        </div>

        <div class="mb-3">
            <label for="peso" class="form-label">Peso</label>
            <input type="text" name="peso" class="form-control">
        </div>

        <div class="mb-3">
            <label for="altura" class="form-label">Altura</label>
            <input type="text" name="altura" class="form-control">
        </div>

        <div class="mb-3">
            <label for="ciudad_origen" class="form-label">Ciudad de origen</label>
            <input type="text" name="ciudad_origen" class="form-control">
        </div>

        <div class="mb-3">
            <label for="biografia" class="form-label">Biografía</label>
            <textarea name="biografia" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('luchadores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
