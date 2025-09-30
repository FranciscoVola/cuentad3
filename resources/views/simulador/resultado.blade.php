@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <header class="mb-4">
            <h1 class="mb-4 titulo-seccion">Resultado del Combate</h1>
        </header>

        <section class="row justify-content-center align-items-center mb-4" aria-label="Luchadores enfrentados">
            <figure class="col-md-4" id="luchador1">
                @if($luchador1->imagen)
                    <img src="{{ asset('storage/' . $luchador1->imagen) }}" 
                         alt="Imagen de {{ $luchador1->nombre }}" 
                         class="img-fluid rounded shadow">
                @else
                    <img src="{{ asset('images/default.jpg') }}" 
                         alt="Imagen por defecto" 
                         class="img-fluid rounded shadow">
                @endif
                <figcaption class="mt-2 fw-bold">{{ $luchador1->nombre }}</figcaption>
            </figure>

            <div class="col-md-1 d-none d-md-block align-self-center">
                <strong aria-hidden="true">VS</strong>
            </div>

            <figure class="col-md-4" id="luchador2">
                @if($luchador2->imagen)
                    <img src="{{ asset('storage/' . $luchador2->imagen) }}" 
                         alt="Imagen de {{ $luchador2->nombre }}" 
                         class="img-fluid rounded shadow">
                @else
                    <img src="{{ asset('images/default.jpg') }}" 
                         alt="Imagen por defecto" 
                         class="img-fluid rounded shadow">
                @endif
                <figcaption class="mt-2 fw-bold">{{ $luchador2->nombre }}</figcaption>
            </figure>
        </section>

        <section class="card shadow mb-4 card-narracion" aria-label="Desarrollo del combate">
            <div class="card-body" id="historia-container">
                {{-- javascript va a insertar todo el relato aca con 1 segundo de margen --}}
            </div>
        </section>

        <section id="ganador-alert" class="alert alert-success d-none" role="alert" aria-live="polite">
            <p class="mb-0 fw-bold">🏆 Ganador: <span class="fw-bold">{{ $ganador->nombre }}</span></p>
        </section>

        <footer>
            <a href="{{ route('simulador') }}" class="btn btn-success mt-3">Volver a simular</a>
        </footer>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const historia = @json($historia);
            const container = document.getElementById('historia-container');
            const ganadorAlert = document.getElementById('ganador-alert');

            const luchador1Id = {{ $luchador1->id }};
            const luchador2Id = {{ $luchador2->id }};
            const ganadorId = {{ $ganador->id }};

            let index = 0;
            const delay = 1000;

            function mostrarLinea() {
                if (index < historia.length) {
                    const linea = document.createElement('p');
                    linea.textContent = historia[index];
                    linea.classList.add('shake');
                    container.appendChild(linea);

                    index++;
                    setTimeout(mostrarLinea, delay);
                } else {
                    ganadorAlert.classList.remove('d-none');
                    ganadorAlert.classList.add('shake');

                    const ganadorDiv = (ganadorId === luchador1Id)
                        ? document.getElementById('luchador1')
                        : document.getElementById('luchador2');
                    ganadorDiv.classList.add('ganador-highlight');
                }
            }

            mostrarLinea();
        });
    </script>
@endsection
