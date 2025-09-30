@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <article class="card bg-dark text-white shadow">

                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                         class="card-img-top img-fluid" 
                         alt="Imagen de {{ $producto->nombre }}">
                @else
                    <img src="{{ asset('images/default.jpg') }}" 
                         class="card-img-top img-fluid" 
                         alt="Imagen por defecto">
                @endif

                <div class="card-body">
                    <header>
                        <h2 class="card-title text-danger">{{ $producto->nombre }}</h2>
                    </header>

                    <section>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="h4 text-white">
                            ${{ number_format($producto->precio, 2, ',', '.') }}
                        </p>
                    </section>

                    <footer class="mt-4 d-flex flex-wrap gap-2">
                        <a href="{{ route('carrito.agregar', $producto->id) }}" class="btn btn-success">🛒 Agregar al carrito</a>
                        <a href="{{ url('/tienda') }}" class="btn btn-secondary">← Volver a la tienda</a>
                    </footer>
                </div>
            </article>
        </div>
    </div>
@endsection
