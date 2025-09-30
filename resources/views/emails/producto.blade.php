<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu compra</title>
</head>
<body>
    <h1>¡Hola {{ Auth::user()->name }}!</h1>

    <p>Gracias por tu compra en CUENTAD3. A continuación, te dejamos los detalles:</p>

    @if($compra->items && count($compra->items))
        <ul>
            @foreach($compra->items as $item)
                <li>
                    {{ $item->producto->nombre }} - Cantidad: {{ $item->cantidad }} - ${{ $item->precio_unitario }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No se encontraron productos asociados a la compra.</p>
    @endif

    <p><strong>Total pagado:</strong> ${{ $compra->total }}</p>

    <p>¡Esperamos que lo disfrutes!<br>CUENTAD3</p>
</body>
</html>
