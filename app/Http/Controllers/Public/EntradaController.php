<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Entrada;
use App\Mail\EntradaComprada;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::orderBy('created_at', 'desc')->get();
        return view('entradas.index', compact('entradas'));
    }

public function comprar(Entrada $entrada)
{
    if ($entrada->precio === null) {
        return back()->with('error', 'Esta entrada aún no tiene precio configurado.');
    }

    session(['entrada_id' => $entrada->id]);

    \MercadoPago\MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

    $item = new \MercadoPago\Resources\Preference\Item();
    $item->title       = $entrada->evento ?: 'Entrada CUENTAD3';
    $item->quantity    = 1;
    $item->unit_price  = (float) $entrada->precio;
    $item->currency_id = 'ARS';

    $client = new \MercadoPago\Client\Preference\PreferenceClient();

    try {
        $preference = $client->create([
            'items' => [$item],
            'back_urls' => [
                'success' => 'https://cuentad3.com/pago/respuesta',
                'failure' => 'https://cuentad3.com/pago/respuesta',
                'pending' => 'https://cuentad3.com/pago/respuesta',
            ],
            'auto_return' => 'approved',
        ]);

        if (empty($preference->init_point)) {
            dd('Respuesta de MP', $preference);
        }

        return redirect()->away($preference->init_point);

    } catch (\MercadoPago\Exceptions\MPApiException $e) {
        dd('Error de MP', $e->getApiResponse()); 
    }
}



    public function respuesta(Request $request)
    {
        $status = $request->query('status');
        $collectionStatus = $request->query('collection_status');
        $aprobado = ($status === 'approved') || ($collectionStatus === 'approved');

        if (!$aprobado) {
            return redirect()->route('home')->with('error', 'El pago fue cancelado o falló.');
        }

        $usuario = Auth::user();
        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Debés iniciar sesión para completar la compra.');
        }

        $entradaId = session('entrada_id') ?? $request->query('external_reference');
        $entradaEvento = $entradaId ? Entrada::find($entradaId) : null;

        $codigo = strtoupper(Str::random(10));

        $datosCrear = [
            'user_id' => $usuario->id,
            'evento'  => $entradaEvento->evento ?? 'Entrada CUENTAD3',
            'codigo'  => $codigo,
            'fecha'   => $entradaEvento->fecha ?? null,
            'hora'    => $entradaEvento->hora ?? null,
            'lugar'   => $entradaEvento->lugar ?? null,
            'precio'  => $entradaEvento->precio ?? null,
            'imagen'  => $entradaEvento->imagen ?? null,
        ];

        try {
            $entradaComprada = Entrada::create($datosCrear);
        } catch (\Throwable $e) {
            Log::error('Error creando entrada comprada', ['error' => $e->getMessage()]);
            return redirect()->route('home')->with('error', 'Pago aprobado pero error al emitir la entrada.');
        }

        try {
            Mail::to($usuario->email)->send(new EntradaComprada($entradaComprada));
        } catch (\Throwable $th) {
            Log::warning('No se pudo enviar el mail de entrada comprada', ['error' => $th->getMessage()]);
        }

        session()->forget('entrada_id');

        return redirect()->route('home')->with('success', '¡Entrada comprada! Revisá tu correo con el QR.');
    }
}
