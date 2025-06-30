@extends('layouts.app')

@section('content')
    <div class="text-center py-5">
        <h1 class="text-danger display-1">404</h1>
        <h2 class="mb-4">Página no encontrada</h2>
        <p>La página que estás buscando no existe o fue eliminada.</p>
        <a href="{{ url('/') }}" class="btn btn-danger mt-4">Volver al inicio</a>
    </div>
@endsection
