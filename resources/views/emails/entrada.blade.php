<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrada confirmada</title>
</head>
<body>
    <main>
        <h1>¡Gracias por tu compra!</h1>

        <p>Te confirmamos que tu entrada fue generada exitosamente para el siguiente evento:</p>

        <section>
            <p><strong>Evento:</strong> {{ $entrada->evento }}</p>
            <p><strong>Fecha de compra:</strong> {{ $entrada->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Código de entrada:</strong> {{ $entrada->codigo }}</p>
        </section>

        <section>
            <p><strong>Evento:</strong> {{ $entrada->evento }}</p>
            <p><strong>Fecha de compra:</strong> {{ $entrada->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Código de entrada:</strong> {{ $entrada->codigo }}</p>

            <figure>
            <figcaption>Escaneá este código para validar tu entrada:</figcaption>
            {!! $qr !!}
            </figure>
        </section>


        <p>Presentá este código (o el QR si está disponible) en la entrada del evento.</p>

        <footer>
            <p>Este correo fue enviado automáticamente desde CUENTAD3. No respondas a este mensaje.</p>
        </footer>
    </main>
</body>
</html>
