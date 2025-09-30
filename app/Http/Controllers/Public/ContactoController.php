<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MensajeContacto;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email',
            'mensaje' => 'required|string|max:1000',
        ]);

        Mail::to('noreply@cuentad3.com')->send(new MensajeContacto(
            $request->nombre,
            $request->email,
            $request->mensaje
        ));

        return back()->with('success', 'Mensaje enviado correctamente. ¡Gracias por contactarnos!');
    }
}
