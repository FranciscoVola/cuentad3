    @php
        $carrito = session('carrito', []);
        $cantidadTotal = array_sum(array_column($carrito, 'cantidad'));
    @endphp
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>CUENTAD3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    <body class="@auth logueado @endauth">

    <nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-danger border-3 px-4">
    <div class="container">
        {{-- Logo a la izquierda --}}
        <a class="navbar-brand d-flex align-items-center me-5" href="{{ url('/') }}">
            <img src="{{ asset('images/negativo.jpg') }}" alt="Logo CuentaD3" style="height: 90px;" class="me-3">
        </a>

        {{-- Botón hamburguesa para mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCuentad3">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Enlaces centrados en escritorio y colapsables en mobile --}}
            <div class="collapse navbar-collapse" id="navbarCuentad3">
                <ul class="navbar-nav gap-3 ms-lg-auto">
                {{-- Enlaces públicos --}}
                <li class="nav-item"><a href="{{ url('/noticias') }}" class="nav-link">Noticias</a></li>
                <li class="nav-item"><a href="{{ url('/tienda') }}" class="nav-link">Tienda</a></li>
                <li class="nav-item"><a href="{{ url('/luchadores') }}" class="nav-link">Luchadores</a></li>
                <li class="nav-item"><a href="{{ url('/simulador') }}" class="nav-link">Simulador</a></li>
                <li class="nav-item"><a href="{{ url('/contacto') }}" class="nav-link">Contacto</a></li>
                <li class="nav-item"><a href="{{ url('/entradas') }}" class="nav-link">Entradas</a></li>

                {{-- Carrito --}}
                <li class="nav-item">
                    <a href="{{ route('carrito.index') }}" class="nav-link position-relative">
                        <i class="bi bi-cart-fill"></i> Carrito
                        @if ($cantidadTotal > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cantidadTotal }}
                                <span class="visually-hidden">productos en el carrito</span>
                            </span>
                        @endif
                    </a>
                </li>

                {{-- Admin --}}
                @auth
                    @if(Auth::user()->rol === 'admin')
                        <li class="nav-item"><a href="{{ url('/admin/panel') }}" class="nav-link">Panel Admin</a></li>
                    @endif
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

    @yield('scripts')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
