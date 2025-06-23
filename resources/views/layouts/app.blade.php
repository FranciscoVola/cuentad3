<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CUENTAD3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-black navbar-expand-@guest lg @else false @endguest">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/negativo.jpg') }}" alt="Logo CuentaD3" style="height: 90px;" class="me-3">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCuentad3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCuentad3">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Inicio</a></li>
                <li class="nav-item"><a href="{{ url('/noticias') }}" class="nav-link">Noticias</a></li>
                <li class="nav-item"><a href="{{ url('/tienda') }}" class="nav-link">Tienda</a></li>
                <li class="nav-item"><a href="{{ url('/luchadores') }}" class="nav-link">Luchadores</a></li>
                <li class="nav-item"><a href="{{ url('/simulador') }}" class="nav-link">Simulador</a></li>
                <li class="nav-item"><a href="{{ url('/contacto') }}" class="nav-link">Contacto</a></li>
                <li class="nav-item"><a href="{{ url('/entradas') }}" class="nav-link">Entradas</a></li>

                @auth
                    <li class="nav-item"><a href="{{ url('/admin/noticias') }}" class="nav-link">Admin Noticias</a></li>
                    <li class="nav-item"><a href="{{ url('/admin/luchadores') }}" class="nav-link">Admin Luchadores</a></li>
                    <li class="nav-item"><a href="{{ url('/admin/productos') }}" class="nav-link">Admin Productos</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="nav-link btn btn-link p-0" style="color: #fff; text-decoration: none;">Cerrar sesión</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrarse</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


<main class="container mt-4">
    @yield('content')
</main>

<footer class="text-center py-3 mt-5">
    &copy; {{ date('Y') }} CUENTAD3 - Plataforma de Lucha Libre Argentina
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
