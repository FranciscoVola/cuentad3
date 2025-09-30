@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h1 class="mb-4 titulo-seccion">¿Olvidaste tu contraseña?</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <p class="mb-4" style="color: #ccc;">
    No hay problema. Ingresá tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
    </p>


    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-light">
                Enviar enlace de recuperación
            </button>
        </div>
    </form>
</div>
@endsection
