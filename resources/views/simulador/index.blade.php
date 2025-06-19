@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1 class="text-danger fw-bold mb-4" style="font-family: Impact, sans-serif;">Simulador de Combates</h1>

    <p>Elegí dos luchadores del roster y descubrí quién ganaría una lucha hipotética. Por ahora, el resultado es totalmente aleatorio, ¡pero igual nos divertimos!</p>

    <form method="POST" action="{{ route('simulador.resultado') }}" class="mt-4">
        @csrf
        <div class="row mb-3">
            <div class="col-md-5">
                <label for="luchador_a" class="form-label">Luchador A</label>
                <select id="luchador_a" name="luchador_a" class="form-select bg-dark text-white border-danger">
                    @foreach ($luchadores as $luchador)
                        <option value="{{ $luchador->nombre }}">{{ $luchador->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 text-center fw-bold fs-3" style="margin-top: 35px;">VS</div>
            <div class="col-md-5">
                <label for="luchador_b" class="form-label">Luchador B</label>
                <select id="luchador_b" name="luchador_b" class="form-select bg-dark text-white border-danger">
                    @foreach ($luchadores as $luchador)
                        <option value="{{ $luchador->nombre }}">{{ $luchador->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-danger w-100">Simular combate</button>
    </form>

    @isset($resultado)
        <div class="alert alert-danger mt-4 text-center fs-4 fw-bold">
            🏆 {{ $resultado }} 🏆
        </div>
    @endisset
</div>
@endsection
