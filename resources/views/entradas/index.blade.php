@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Próximos Eventos</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Evento 1 -->
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('images/evento1.jpg') }}" class="card-img-top" alt="Evento 1">
                <div class="card-body">
                    <h5 class="card-title">CuentaD3: Resurrección</h5>
                    <p class="card-text">📍 Estadio Luna Park<br>🗓️ 30 de junio, 2025<br>⌚ 20:00 hs</p>
                    <button class="btn btn-danger w-100" disabled>Próximamente</button>
                </div>
            </div>
        </div>

        <!-- Evento 2 -->
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('images/evento2.jpg') }}" class="card-img-top" alt="Evento 2">
                <div class="card-body">
                    <h5 class="card-title">CuentaD3: Guerra Total</h5>
                    <p class="card-text">📍 Microestadio Morón<br>🗓️ 15 de julio, 2025<br>⌚ 19:00 hs</p>
                    <button class="btn btn-danger w-100" disabled>Próximamente</button>
                </div>
            </div>
        </div>

        <!-- Evento 3 -->
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('images/evento3.jpg') }}" class="card-img-top" alt="Evento 3">
                <div class="card-body">
                    <h5 class="card-title">CuentaD3: Destino Final</h5>
                    <p class="card-text">📍 Teatro Flores<br>🗓️ 28 de julio, 2025<br>⌚ 21:00 hs</p>
                    <button class="btn btn-danger w-100" disabled>Próximamente</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
