@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1 class="mb-4 titulo-seccion">Simulador de Combates</h1>

    <p>Elegí dos luchadores del roster y descubrí quién ganaría una lucha hipotética. Por ahora, el resultado es totalmente aleatorio, ¡pero igual nos divertimos!</p>

    @if ($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('simulador.resultado') }}" class="mt-4">
        @csrf
        <div class="row mb-3">
            <div class="col-md-5">
                <label for="luchador1" class="form-label">Luchador A</label>
                <select id="luchador1" name="luchador1" class="form-select bg-dark text-white border-danger">
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($luchadores as $luchador)
                        <option value="{{ $luchador->id }}">{{ $luchador->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 text-center fw-bold fs-3" style="margin-top: 35px;">VS</div>
            <div class="col-md-5">
                <label for="luchador2" class="form-label">Luchador B</label>
                <select id="luchador2" name="luchador2" class="form-select bg-dark text-white border-danger">
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($luchadores as $luchador)
                        <option value="{{ $luchador->id }}">{{ $luchador->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-light w-50">Simular combate</button>
        </div>
    </form>
</div>
@endsection
