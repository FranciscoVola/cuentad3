@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card bg-dark text-white shadow-lg">
                @if($noticia->imagen)
                    <img src="{{ asset('storage/' . $noticia->imagen) }}" 
                         class="card-img-top img-fluid" 
                         alt="Imagen de {{ $noticia->titulo }}">
                @else
                    <img src="{{ asset('images/default.jpg') }}" 
                         class="card-img-top img-fluid" 
                         alt="Imagen por defecto">
                @endif

                <div class="card-body">
                    <h2 class="card-title text-danger">{{ $noticia->titulo }}</h2>
                    <p class="text-muted">
                        Fecha: {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}
                    </p>
                    <hr class="border-danger">
                    <p class="card-text">{{ $noticia->contenido }}</p>

                    <a href="{{ url('/noticias') }}" class="btn btn-outline-light mt-4">← Volver a Noticias</a>
                </div>
            </div>

        </div>
    </div>
@endsection
