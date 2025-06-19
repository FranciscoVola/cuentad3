@extends('layouts.app')

@section('content')
<style>
    .versus-box {
        background-color: black;
        padding: 20px;
        border: 3px solid #E10600;
        animation: pulse 1s infinite alternate;
    }

    .versus-box .luchador {
        font-family: Impact, sans-serif;
        font-size: 1.5rem;
        background: #111;
        padding: 15px;
        margin: 10px;
        border: 2px solid #E10600;
        text-align: center;
    }

    .result-anim {
        animation: pop 0.6s ease forwards;
    }

    @keyframes pulse {
        from { box-shadow: 0 0 5px #E10600; }
        to { box-shadow: 0 0 20px #E10600; }
    }

    @keyframes pop {
        0% { transform: scale(0.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>

<div class="container text-white">
    <h1 class="text-danger fw-bold mb-4" style="font-family: Impact, sans-serif;">¡Simulador Arcade!</h1>

    <div class="versus-box text-center">
        <div class="row justify-content-center">
            <div class="col-md-5 luchador">💥 El Enmascarado 💥</div>
            <div class="col-md-2 text-danger fw-bold fs-3 align-self-center">VS</div>
            <div class="col-md-5 luchador">🔥 La Bestia Roja 🔥</div>
        </div>

        <button class="btn btn-danger mt-4" onclick="simularCombate()">Simular Combate</button>

        <div id="resultado" class="mt-4 fs-4 fw-bold text-danger"></div>
    </div>
</div>

<script>
    function simularCombate() {
        const luchadores = ["El Enmascarado", "La Bestia Roja"];
        const ganador = luchadores[Math.floor(Math.random() * luchadores.length)];
        const resultado = `🏆 ¡${ganador} gana el combate! 🏆`;

        const contenedor = document.getElementById('resultado');
        contenedor.classList.remove('result-anim');
        void contenedor.offsetWidth; // reinicia animación
        contenedor.textContent = resultado;
        contenedor.classList.add('result-anim');
    }
</script>
@endsection
