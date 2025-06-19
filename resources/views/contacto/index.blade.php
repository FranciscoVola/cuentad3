@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1 class="text-danger fw-bold mb-4" style="font-family: Impact, sans-serif;">Contacto</h1>

    <p class="mb-4">¿Tenés alguna duda, propuesta o querés comunicarte con nosotros? Completá el formulario y te respondemos lo antes posible.</p>

    <form>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control bg-dark text-white border-danger" id="nombre" placeholder="Tu nombre">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control bg-dark text-white border-danger" id="email" placeholder="nombre@ejemplo.com">
        </div>

        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control bg-dark text-white border-danger" id="mensaje" rows="5" placeholder="Escribí tu mensaje acá..."></textarea>
        </div>

        <button type="submit" class="btn btn-danger">Enviar</button>
    </form>
</div>
@endsection
