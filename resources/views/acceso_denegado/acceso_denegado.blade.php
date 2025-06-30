@extends('layouts.app')

@section('content')
    <div class="text-center py-5">
        <h1 class="text-danger">Acceso Denegado</h1>
        <p>No tenés permisos para ingresar a esta sección.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
@endsection
