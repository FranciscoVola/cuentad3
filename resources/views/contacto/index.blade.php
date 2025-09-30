@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1 class="mb-4 titulo-seccion">Contacto</h1>

    <p class="mb-4">¿Tenés alguna duda, propuesta o querés comunicarte con nosotros? Completá el formulario y te respondemos lo antes posible.</p>

    {{-- Mensaje de éxito si el mail se envió correctamente --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mostrar errores de validación --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contacto.enviar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control bg-dark text-white border-danger" id="nombre" placeholder="Tu nombre" value="{{ old('nombre') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control bg-dark text-white border-danger" id="email" placeholder="nombre@ejemplo.com" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea name="mensaje" class="form-control bg-dark text-white border-danger" id="mensaje" rows="5" placeholder="Escribí tu mensaje acá...">{{ old('mensaje') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
</div>
@endsection
