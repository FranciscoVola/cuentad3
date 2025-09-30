@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h1 class="mb-4 titulo-seccion">Restablecer Contraseña</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input id="email" type="email" class="form-control" name="email"
                value="{{ old('email', $request->email) }}" required autofocus>
        </div>

        <!-- Nueva contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">
                Nueva contraseña <small style="color: #ffffff;">(mínimo 8 caracteres)</small>
            </label>
            <div class="input-group">
                <input id="password" type="password" class="form-control" name="password" required>
                <button type="button" class="btn btn-outline-light" onclick="togglePassword('password', this)">Mostrar</button>
            </div>
        </div>


        <!-- Confirmación de contraseña -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <div class="input-group">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                <button type="button" class="btn btn-outline-light" onclick="togglePassword('password_confirmation', this)">Mostrar</button>
            </div>
        </div>


        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Restablecer contraseña</button>
        </div>
    </form>
</div>
<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = 'Ocultar';
        } else {
            input.type = 'password';
            btn.textContent = 'Mostrar';
        }
    }
</script>

@endsection
