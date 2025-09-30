<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Producto;
use App\Models\Luchador;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $noticias = Noticia::latest()->take(3)->get();
        $productos = Producto::latest()->take(3)->get();
        return view('home', compact('noticias', 'productos'));
    }

    public function noticias()
    {
        $noticias = Noticia::latest()->get();
        return view('noticias.index', compact('noticias'));
    }

    public function noticiaDetalle($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('noticias.detalle', compact('noticia'));
    }

    public function tienda()
    {
        $productos = Producto::all();
        return view('tienda.index', compact('productos'));
    }

    public function productoDetalle($id)
    {
        $producto = Producto::findOrFail($id);
        return view('tienda.detalle', compact('producto'));
    }

    public function entradas()
    {
        return view('entradas.index');
    }

    public function luchadores()
    {
        $luchadores = Luchador::all();
        return view('luchadores.index', compact('luchadores'));
    }

    public function luchadorDetalle($id)
    {
        $luchador = Luchador::findOrFail($id);
        return view('luchadores.detalle', compact('luchador'));
    }

    public function ranking()
    {
        $luchadores = Luchador::latest()->take(9)->get();
        return view('ranking.index', compact('luchadores'));
    }

    public function contacto()
    {
        return view('contacto.index');
    }

    public function sobre()
    {
        return view('sobre.index');
    }

    public function simulador()
    {
        $luchadores = Luchador::all();
        return view('simulador.index', compact('luchadores'));
    }

    public function simuladorResultado(Request $request)
    {
        $a = $request->luchador_a;
        $b = $request->luchador_b;

        if ($a === $b) {
            $resultado = "¡$a se ganó a sí mismo! 🌀 Esto no debería pasar...";
        } else {
            $ganador = rand(0, 1) ? $a : $b;
            $resultado = "¡$ganador ganó el combate!";
        }

        $luchadores = Luchador::all();
        return view('simulador.index', compact('luchadores', 'resultado'));
    }

    public function simuladorArcade()
    {
        return view('simulador.arcade');
    }

    public function accesoDenegado()
    {
        return view('acceso_denegado.acceso_denegado');
    }

    public function usuariosIndex()
    {
        $usuarios = User::withCount('noticias')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function usuariosShow($id)
    {
        $usuario = User::with('noticias')->findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }
}
