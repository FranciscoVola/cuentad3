<?php

use Illuminate\Support\Facades\Route;
use App\Models\Noticia;
use App\Models\Producto;
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

//luchadores
Route::get('/luchadores', [LuchadorController::class, 'publicIndex']);
Route::get('/luchador/{id}', [LuchadorController::class, 'publicShow'])->name('luchador.detalle');


//auth
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('noticias', NoticiaController::class);
    Route::resource('productos', ProductoController::class);
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('luchadores', LuchadorController::class);
});


require __DIR__.'/auth.php';

