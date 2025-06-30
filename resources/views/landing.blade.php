<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lanzamiento | CuentaD3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Estilos -->
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: white;
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Impact', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero {
            background-image: url('/images/banner.png'); /* Usá una imagen tuya o temática */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-color: rgba(0,0,0,0.7);
        }

        .hero-content {
            position: relative;
            text-align: center;
            z-index: 2;
        }

        .hero-content h1 span {
            color: #e50914;
        }

        .btn-danger {
            background-color: #e50914;
            border: none;
            font-weight: bold;
            text-transform: uppercase;
            padding: 0.8rem 2rem;
        }

        .btn-danger:hover {
            background-color: #c10000;
        }

        .seccion-info {
            padding: 4rem 2rem;
            background-color: #1a1a1a;
            text-align: center;
        }

        footer {
            padding: 1.5rem;
            background-color: black;
            text-align: center;
            color: #ccc;
            border-top: 3px solid #e50914;
        }
    </style>
</head>
<body>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="display-3">¡Bienvenidos a CUENTA<span>D3</span>!</h1>
            <p class="lead">La nueva plataforma de lucha libre argentina</p>
            <a href="#info" class="btn btn-danger mt-4">Ver más</a>
        </div>
    </section>

    <!-- Info -->
    <section id="info" class="seccion-info">
        <div class="container">
            <h2 class="mb-4">¿Qué es CuentaD3?</h2>
            <p class="lead">Es una comunidad digital que reúne fanáticos, luchadores y promotores del wrestling argentino.</p>
            <p>Noticias, combates simulados, venta de entradas, perfiles de luchadores y más.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        © 2025 CuentaD3 - Todos los derechos reservados.
    </footer>

</body>
</html>
