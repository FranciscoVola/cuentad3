@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2>Resultado del pago</h2>
    @if ($status === 'approved')
        <p class="text-success">✅ ¡Pago aprobado!</p>
        <p>ID de pago: {{ $payment_id }}</p>
    @elseif ($status === 'pending')
        <p class="text-warning">⌛ Tu pago está pendiente.</p>
    @else
        <p class="text-danger">❌ El pago fue rechazado o cancelado.</p>
    @endif
</div>
@endsection
