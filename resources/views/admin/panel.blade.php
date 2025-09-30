@extends('layouts.app')

@section('content')
    <div class="container text-white">
        <h1 class="mb-4 titulo-seccion">Panel de Administración</h1>

        <div class="list-group">
            <a href="{{ url('/admin/noticias') }}" class="list-group-item list-group-item-action bg-dark text-white">📰 Gestionar Noticias</a>
            <a href="{{ url('/admin/luchadores') }}" class="list-group-item list-group-item-action bg-dark text-white">🤼‍♂️ Gestionar Luchadores</a>
            <a href="{{ url('/admin/productos') }}" class="list-group-item list-group-item-action bg-dark text-white">🛒 Gestionar Productos</a>
            <a href="{{ route('entradas-admin.index') }}" class="list-group-item list-group-item-action bg-dark text-white">🎟️ Gestionar Entradas</a>
        </div>
    </div>
@endsection
