@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 titulo-seccion">Próximos eventos</h1>

    @if ($entradas->isEmpty())
        <p class="text-center">Aún no hay eventos disponibles.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($entradas as $entrada)
                <div class="col">
                    <div class="card h-100">

                        @if ($entrada->imagen)
                            <img src="{{ asset('storage/' . $entrada->imagen) }}" 
                                 class="card-img-top" 
                                 alt="Imagen del evento">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" 
                                 class="card-img-top" 
                                 alt="Imagen por defecto">
                        @endif

                        <div class="card-body">
                            <h3 class="card-title">{{ $entrada->evento }}</h3>

                            <p class="card-text">
                                📍 <strong>Lugar:</strong> {{ $entrada->lugar ?? 'A confirmar' }}<br>
                                🗓️ <strong>Fecha:</strong> 
                                {{ $entrada->fecha ? \Carbon\Carbon::parse($entrada->fecha)->format('d/m/Y') : 'A confirmar' }}<br>
                                💲 <strong>Precio:</strong> 
                                {{ isset($entrada->precio) ? '$' . number_format($entrada->precio, 2, ',', '.') : 'A confirmar' }}<br>
                                ⏰ <strong>Hora:</strong> {{ $entrada->hora ?? 'A confirmar' }}
                            </p>

                            @auth
                               <a href="{{ route('entrada.comprar', $entrada->id) }}" class="btn btn-success w-100">Comprar Entrada</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Iniciá sesión para comprar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
