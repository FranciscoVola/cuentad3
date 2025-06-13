@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Luchadores</h1>

    <a href="{{ route('luchadores.create') }}" class="btn btn-primary mb-3">Agregar Luchador</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Alias</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>Ciudad</th>
                <th>Biografía</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($luchadores as $luchador)
                <tr>
                    <td>
                        @if ($luchador->imagen)
                            <img src="{{ asset($luchador->imagen) }}" alt="Imagen de {{ $luchador->nombre }}" width="60" class="img-thumbnail">
                        @else
                            <em>Sin imagen</em>
                        @endif
                    </td>
                    <td>{{ $luchador->nombre }}</td>
                    <td>{{ $luchador->alias }}</td>
                    <td>{{ $luchador->peso }}</td>
                    <td>{{ $luchador->altura }}</td>
                    <td>{{ $luchador->ciudad_origen }}</td>
                    <td>{{ Str::limit($luchador->biografia, 50) }}</td>
                    <td>
                        <a href="{{ route('luchadores.edit', $luchador->id) }}" class="btn btn-sm btn-warning mb-1">Editar</a>

                        <form action="{{ route('luchadores.destroy', $luchador->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
