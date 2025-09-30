@extends('layouts.app')

@section('content')
<div class="container text-white">
    <a href="{{ url('/luchadores') }}" class="btn btn-light mb-4">← Volver al listado</a>

    <h1 class="mb-4 text-center">Ficha del Luchador</h1>

    <div class="row">
        <div class="col-md-4 mb-3">
            @if($luchador->imagen)
                <img src="{{ asset('storage/' . $luchador->imagen) }}" 
                     class="card-img-top img-fluid" 
                     alt="{{ $luchador->nombre }}">
            @else
                <img src="{{ asset('images/default.jpg') }}" 
                     class="card-img-top img-fluid" 
                     alt="Imagen por defecto">
            @endif
        </div>

        <div class="col-md-8">
            <h2 class="text-danger fw-bold">{{ $luchador->nombre }}</h2>

            @if($luchador->alias)
                <h3 class="text-white-50 mb-3">
                    Alias: <strong class="text-white">{{ $luchador->alias }}</strong>
                </h3>
            @endif

            <ul class="list-unstyled mb-3">
                @if($luchador->peso)
                    <li><strong>Peso:</strong> {{ $luchador->peso }} kg</li>
                @endif
                @if($luchador->altura)
                    <li><strong>Altura:</strong> {{ $luchador->altura }} m</li>
                @endif
                @if($luchador->ciudad_origen)
                    <li><strong>Ciudad de origen:</strong> {{ $luchador->ciudad_origen }}</li>
                @endif
            </ul>

            @if($luchador->biografia)
                <div class="bg-dark p-3 border border-danger rounded">
                    <h3 class="text-danger">Biografía</h3>
                    <p class="mb-0">{{ $luchador->biografia }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
