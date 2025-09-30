@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1 class="mb-4 titulo-seccion">Tu carrito</h1>

    @if(session('success'))
        <section class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </section>
    @endif

    @if (count($carrito) === 0)
        <section class="text-center">
            <p>No hay productos en el carrito.</p>
            <a href="{{ route('tienda') }}" class="btn btn-outline-light mt-2">Ir a la tienda</a>
        </section>
    @else
        <section class="table-responsive">
            <table class="table table-dark table-bordered align-middle">
                <thead class="table-danger">
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($carrito as $item)
                        @php 
                            $subtotal = $item['precio'] * $item['cantidad']; 
                            $total += $subtotal; 
                        @endphp
                        <tr>
                            <td>
                                @if(!empty($item['imagen']))
                                    <img src="{{ asset('storage/' . $item['imagen']) }}" 
                                         alt="{{ $item['nombre'] }}" 
                                         width="60">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" 
                                         alt="Imagen por defecto" 
                                         width="60">
                                @endif
                            </td>
                            <td>{{ $item['nombre'] }}</td>
                            <td>${{ number_format($item['precio'], 2) }}</td>
                            <td>{{ $item['cantidad'] }}</td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <a href="{{ route('carrito.quitar', $item['id']) }}" class="btn btn-sm btn-danger">Quitar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="text-end">
            <p class="fs-5 fw-bold text-white">Total: ${{ number_format($total, 2) }}</p>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('carrito.vaciar') }}" class="btn btn-warning">Vaciar carrito</a>
                <a href="{{ route('pago.iniciar') }}" class="btn btn-success">Finalizar compra</a>
            </div>
        </section>
    @endif
</div>
@endsection
