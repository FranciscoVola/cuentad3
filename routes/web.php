<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\CarritoController;
use App\Http\Controllers\Public\PagoController;
use App\Http\Controllers\Public\SimuladorController;
use App\Http\Controllers\Public\ContactoController;
use App\Http\Controllers\Public\EntradaController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\LuchadorController;
use App\Http\Controllers\Admin\EntradaAdminController;

// -----------------------------
//  Rutas públicas
// -----------------------------

// Home
Route::get('/', [HomeController::class, 'home'])->name('home');

// Noticias
Route::get('/noticias', [HomeController::class, 'noticias'])->name('noticias');
Route::get('/noticia/{id}', [HomeController::class, 'noticiaDetalle'])->name('noticia.detalle');

// Tienda
Route::get('/tienda', [HomeController::class, 'tienda'])->name('tienda');
Route::get('/producto/{id}', [HomeController::class, 'productoDetalle'])->name('producto.detalle');

// Entradas públicas
Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');

Route::middleware('auth')->group(function () {
Route::get('/entrada/{entrada}/comprar', [EntradaController::class, 'comprar'])->name('entrada.comprar');
Route::get('/entrada/respuesta', [EntradaController::class, 'respuesta'])->name('entrada.respuesta');
});


// Luchadores
Route::get('/luchadores', [HomeController::class, 'luchadores'])->name('luchadores');
Route::get('/luchador/{id}', [HomeController::class, 'luchadorDetalle'])->name('luchador.detalle');
Route::get('/ranking', [HomeController::class, 'ranking'])->name('ranking');

// Simulador
Route::get('/simulador', [SimuladorController::class, 'index'])->name('simulador');
Route::post('/simulador', [SimuladorController::class, 'resultado'])->name('simulador.resultado');
Route::get('/simulador-arcade', [HomeController::class, 'simuladorArcade'])->name('simulador.arcade');

// Contacto
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

// Información
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');
Route::get('/acceso-denegado', [HomeController::class, 'accesoDenegado'])->name('acceso.denegado');

// -----------------------------
//  Carrito
// -----------------------------

Route::middleware(['auth'])->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::get('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito/quitar/{id}', [CarritoController::class, 'quitar'])->name('carrito.quitar');
    Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::post('/carrito/finalizar', [CarritoController::class, 'finalizar'])->name('carrito.finalizar');
});

// -----------------------------
//  Mercado Pago
// -----------------------------

Route::get('/pago/iniciar', [PagoController::class, 'iniciarPago'])->name('pago.iniciar');
Route::get('/pago/respuesta', [PagoController::class, 'respuesta'])->name('pago.respuesta');

// -----------------------------
// Panel de Administración
// -----------------------------

Route::middleware(['auth', 'admin'])->get('/admin/panel', function () {
    return view('admin.panel');
})->name('admin.panel');

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::resource('noticias', NoticiaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('entradas', EntradaAdminController::class)->names('entradas-admin');
    Route::resource('luchadores', LuchadorController::class);

    // Confirmaciones antes de eliminar
    Route::get('noticias/{id}/confirmar-eliminacion', [NoticiaController::class, 'confirmDelete'])->name('noticias.confirmDelete');
    Route::get('productos/{id}/confirmar-eliminacion', [ProductoController::class, 'confirmDelete'])->name('productos.confirmDelete');
    Route::get('luchadores/{id}/confirmar-eliminacion', [LuchadorController::class, 'confirmDelete'])->name('luchadores.confirmDelete');
    Route::get('entradas/{id}/confirmar-eliminacion', [EntradaAdminController::class, 'confirmDelete'])->name('entradas-admin.confirmDelete');
});

// -----------------------------
// Vista de Usuarios (Admin)
// -----------------------------

Route::middleware(['auth', 'admin'])->get('/usuarios', [HomeController::class, 'usuariosIndex'])->name('usuarios.index');
Route::middleware(['auth', 'admin'])->get('/usuarios/{id}', [HomeController::class, 'usuariosShow'])->name('usuarios.show');

// -----------------------------
// Auth
// -----------------------------

require __DIR__ . '/auth.php';
