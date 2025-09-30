@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1 class="mb-4 titulo-seccion">Luchadores</h1>

    <div class="row">
        @foreach ($luchadores as $luchador)
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-white border border-danger h-100">

                    @if($luchador->imagen)
                        <img src="{{ asset('storage/' . $luchador->imagen) }}" 
                             class="card-img-top" 
                             alt="{{ $luchador->nombre }}">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             class="card-img-top" 
                             alt="Imagen por defecto">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title text-danger" style="font-family: Impact, sans-serif;">
                            {{ $luchador->nombre }}
                        </h5>
                        <p class="card-text"><strong>Alias:</strong> {{ $luchador->alias }}</p>
                        <p class="card-text">{{ Str::limit($luchador->biografia, 80) }}</p>
                        <a href="{{ route('luchador.detalle', $luchador->id) }}" 
                           class="btn btn-outline-light w-100">
                           Ver Perfil
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
