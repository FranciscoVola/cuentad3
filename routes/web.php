<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Producto;
use App\Models\Luchador;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\LuchadorController;

// Landing
Route::get('/', function () {
    $noticias = Noticia::latest()->take(3)->get();
    $productos = Producto::latest()->take(3)->get();
    return view('home', compact('noticias', 'productos'));
})->name('home');

// Noticias
Route::get('/noticias', function () {
    $noticias = Noticia::latest()->get();
    return view('noticias.index', compact('noticias'));
});

Route::get('/noticia/{id}', function ($id) {
    $noticia = Noticia::findOrFail($id);
    return view('noticias.detalle', compact('noticia'));
})->name('noticia.detalle');

// Tienda
Route::get('/tienda', function () {
    $productos = Producto::all();
    return view('tienda.index', compact('productos'));
});


Route::get('/producto/{id}', function ($id) {
    $producto = Producto::findOrFail($id);
    return view('tienda.detalle', compact('producto'));
})->name('producto.detalle');


// Entradas
Route::get('/entradas', function () {
    return view('entradas.index');
})->name('entradas');


//luchadores
Route::get('/luchadores', function () {
    $luchadores = Luchador::all();
    return view('luchadores.index', compact('luchadores'));
});

Route::get('/luchador/{id}', function ($id) {
    $luchador = Luchador::findOrFail($id);
    return view('luchadores.detalle', compact('luchador'));
})->name('luchador.detalle');


//ranking de luchadores
Route::get('/ranking', function () {
    $luchadores = Luchador::latest()->take(9)->get();
    return view('ranking.index', compact('luchadores'));
})->name('ranking');


//contacto
Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto');

//sobre nosotros
Route::get('/sobre', function () {
    return view('sobre.index');
})->name('sobre');

//simulador de combates
Route::get('/simulador', function () {
    $luchadores = Luchador::all();
    return view('simulador.index', compact('luchadores'));
})->name('simulador');

Route::post('/simulador', function (Request $request) {
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
})->name('simulador.resultado');


Route::get('/simulador-arcade', function () {
    return view('simulador.arcade');
})->name('simulador.arcade');

//auth
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('noticias', NoticiaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('luchadores', LuchadorController::class);

});



require __DIR__.'/auth.php';

