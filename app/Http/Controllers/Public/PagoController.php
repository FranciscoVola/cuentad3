<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Resources\Preference\Item;
use MercadoPago\Exceptions\MPApiException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function iniciarPago()
    {
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        $items = [];

        foreach ($carrito as $producto) {
            $item = new Item();
            $item->title = $producto['nombre'];
            $item->quantity = $producto['cantidad'];
            $item->unit_price = (float) $producto['precio'];
            $item->currency_id = 'ARS';
            $items[] = $item;
        }

        $client = new PreferenceClient();

        try {
            $preference = $client->create([
                'items' => $items,
                'back_urls' => [
                'success' => 'https://cuentad3.com/pago/respuesta',
                'failure' => 'https://cuentad3.com/pago/respuesta',
                'pending' => 'https://cuentad3.com/pago/respuesta',
            ],
                'auto_return' => 'approved'
            ]);
        } catch (MPApiException $e) {
            dd($e->getApiResponse());
        }

        return view('pago.checkout', [
            'preference_id' => $preference->id,
            'public_key' => env('MERCADOPAGO_PUBLIC_KEY'),
        ]);
    }

    public function respuesta(Request $request)
    {
        $status = $request->input('status');

        if ($status === 'approved') {
            $usuario = Auth::user();
            $carrito = session('carrito', []);

            if (!$usuario || empty($carrito)) {
                return redirect()->route('home')->with('error', 'No se pudo registrar la compra.');
            }

            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            // Guardar en tabla 'compras'
            $compraId = DB::table('compras')->insertGetId([
                'id_usuario' => $usuario->id,
                'fecha_compra' => now(),
                'total' => $total,
            ]);

            // Guardar en tabla 'detalle_compras'
            foreach ($carrito as $item) {
                DB::table('detalle_compras')->insert([
                    'id_compra' => $compraId,
                    'id_producto' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                ]);
            }

            session()->forget('carrito');

            return view('pago.respuesta', [
                'status' => 'approved',
                'payment_id' => $request->input('payment_id'),
                'merchant_order_id' => $request->input('merchant_order_id'),
            ]);
        }

        return view('pago.respuesta', [
            'status' => $status,
            'payment_id' => $request->input('payment_id'),
            'merchant_order_id' => $request->input('merchant_order_id'),
        ]);
    }
}