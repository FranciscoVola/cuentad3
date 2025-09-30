@extends('layouts.app') 
@section('content')
<div class="container text-center">
    <h2 class="my-4">Confirmar pago</h2>

    <div id="wallet_container"></div>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("{{ $public_key }}");

        mp.bricks().create("wallet", "wallet_container", {
            initialization: {
                preferenceId: "{{ $preference_id }}"
            },
            customization: {
                texts: {
                    valueProp: 'smart_option'
                }
            }
        });
    </script>
</div>
@endsection
