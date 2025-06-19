@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1 class="text-danger fw-bold mb-4" style="font-family: Impact, sans-serif;">Ranking de Luchadores</h1>

    <p class="mb-4">Este ranking destaca a los luchadores más activos, votados y reconocidos del circuito independiente.</p>

    <div class="row">
        @foreach ($luchadores as $index => $luchador)
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-white border border-danger h-100">
                    <img src="{{ asset('storage/' . $luchador->imagen) }}" class="card-img-top" alt="{{ $luchador->nombre }}">
                    <div class="card-body">
                        <h5 class="card-title" style="font-family: Impact, sans-serif;">
                            #{{ $index + 1 }} - {{ $luchador->nombre }}
                        </h5>
                        <p class="card-text"><strong>Alias:</strong> {{ $luchador->alias }}</p>
                        <a href="{{ route('luchador.detalle', $luchador->id) }}" class="btn btn-danger w-100">Ver Perfil</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
