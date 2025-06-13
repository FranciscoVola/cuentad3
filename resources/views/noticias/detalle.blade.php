@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-dark text-white shadow">
                <div class="card-body">
                    <h2 class="card-title text-danger">{{ $noticia->titulo }}</h2>
                    <p class="text-muted mb-2">Fecha: {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</p>
                    <p class="card-text">{{ $noticia->contenido }}</p>
                    <a href="{{ url('/noticias') }}" class="btn btn-secondary mt-3">← Volver a Noticias</a>
                </div>
            </div>
        </div>
    </div>
@endsection
