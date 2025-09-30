@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Agregar nueva entrada</h1>

    <form action="{{ route('entradas-admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="evento" class="form-label">Nombre del evento *</label>
            <input type="text" name="evento" id="evento" class="form-control" value="{{ old('evento') }}" required>
            @error('evento')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha del evento</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}">
            @error('fecha')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora del evento</label>
            <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora') }}">
            @error('hora')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lugar" class="form-label">Lugar del evento</label>
            <input type="text" name="lugar" id="lugar" class="form-control" value="{{ old('lugar') }}">
            @error('lugar')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="{{ old('precio') }}">
            @error('precio')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <small class="text-light">Ingresá el precio en pesos argentinos (ej: 1500.00).</small>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del evento (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
            @error('imagen')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <small class="text-light">Solo se permiten imágenes jpeg, png, jpg, gif, svg, webp. Máx 2MB.</small>
        </div>

        <button type="submit" class="btn btn-success">Guardar entrada</button>
        <a href="{{ route('entradas-admin.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
