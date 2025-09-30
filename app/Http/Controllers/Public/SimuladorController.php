<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Luchador;

class SimuladorController extends Controller
{
    public function index()
    {
        $luchadores = Luchador::all();
        return view('simulador.index', compact('luchadores'));
    }

    public function resultado(Request $request)
    {
        $request->validate([
            'luchador1' => 'required|different:luchador2',
            'luchador2' => 'required',
        ], [
            'luchador1.required' => 'Tenés que seleccionar un luchador para el lado A.',
            'luchador2.required' => 'Tenés que seleccionar un luchador para el lado B.',
            'luchador1.different' => 'Los luchadores tienen que ser distintos.',
            ]);



        $luchador1 = Luchador::findOrFail($request->input('luchador1'));
        $luchador2 = Luchador::findOrFail($request->input('luchador2'));

        // Lógica simple de combate aleatorio
        $ganador = rand(0, 1) ? $luchador1 : $luchador2;

        // Historia estilo narración de la pelea
        $historia = [
            "🔥 ¡Empieza la pelea entre {$luchador1->nombre} y {$luchador2->nombre}!",
            "⚔️ {$luchador1->nombre} ataca primero, buscando el dominio temprano.",
            "💥 {$luchador2->nombre} responde con una técnica sorpresa.",
            "🥵 ¡Ambos luchadores están al límite de sus fuerzas!",
            "🏆 ¡Finalmente, {$ganador->nombre} se impone con su movida final!",
        ];

        return view('simulador.resultado', compact('luchador1', 'luchador2', 'ganador', 'historia'));
    }
}
