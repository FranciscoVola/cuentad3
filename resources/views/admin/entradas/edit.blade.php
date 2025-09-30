@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar entrada</h1>

    <form action="{{ route('entradas-admin.update', $entrada->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="evento" class="form-label">Nombre del evento *</label>
            <input type="text" name="evento" id="evento" class="form-control" value="{{ old('evento', $entrada->evento) }}" required>
            @error('evento')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha del evento</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $entrada->fecha) }}">
            @error('fecha')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora del evento</label>
            <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora', $entrada->hora) }}">
            @error('hora')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lugar" class="form-label">Lugar del evento</label>
            <input type="text" name="lugar" id="lugar" class="form-control" value="{{ old('lugar', $entrada->lugar) }}">
            @error('lugar')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo de precio --}}
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="{{ old('precio', $entrada->precio) }}">
            @error('precio')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <small class="text-light">Ingresá el precio en pesos argentinos (ej: 1500.00).</small>
        </div>

        @if ($entrada->imagen)
            <div class="mb-3">
                <p>Imagen actual:</p>
                <img src="{{ asset('storage/' . $entrada->imagen) }}" alt="Imagen de la entrada" class="img-fluid" style="max-width: 300px;">
            </div>
        @endif

        <div class="mb-3">
            <label for="imagen" class="form-label">Cambiar imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
            @error('imagen')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <small class="text-light">Solo se permiten imágenes jpeg, png, jpg, gif, svg, webp. Máx 2MB.</small>
        </div>

        <button type="submit" class="btn btn-success">Actualizar entrada</button>
        <a href="{{ route('entradas-admin.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
