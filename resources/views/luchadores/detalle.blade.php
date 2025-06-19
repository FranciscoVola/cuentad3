@extends('layouts.app')

@section('content')
<div class="container text-white">
    <a href="{{ url('/luchadores') }}" class="btn btn-outline-light mb-4">← Volver al listado</a>

    <div class="row">
        <div class="col-md-4 mb-3">
            <img src="{{ asset($luchador->imagen) }}" alt="{{ $luchador->nombre }}" class="img-fluid rounded border border-danger">
        </div>

        <div class="col-md-8">
            <h1 class="text-danger fw-bold" style="font-family: Impact, sans-serif;">{{ $luchador->nombre }}</h1>
            @if($luchador->alias)
                <h4 class="text-white-50 mb-3">Alias: <strong>{{ $luchador->alias }}</strong></h4>
            @endif

            <ul class="list-unstyled mb-3">
                @if($luchador->peso)
                    <li><strong>Peso:</strong> {{ $luchador->peso }}<strong>Kg</strong></li>
                @endif
                @if($luchador->altura)
                    <li><strong>Altura:</strong> {{ $luchador->altura }}<strong>CM</strong></li>
                @endif
                @if($luchador->ciudad_origen)
                    <li><strong>Ciudad de origen:</strong> {{ $luchador->ciudad_origen }}</li>
                @endif
            </ul>

            @if($luchador->biografia)
                <div class="bg-dark p-3 border border-danger rounded">
                    <h5 class="text-danger">Biografía</h5>
                    <p>{{ $luchador->biografia }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
