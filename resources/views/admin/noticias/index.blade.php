@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <h1>Administrar Noticias</h1>
        <a href="{{ route('noticias.create') }}" class="btn btn-primary">Agregar nueva</a>
    </div>

    @if($noticias->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($noticias as $noticia)
                    <tr>
                        <td>{{ $noticia->titulo }}</td>
                        <td>{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" style="display:inline-block">
                                @csrf
                             @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay noticias cargadas.</p>
    @endif
@endsection
