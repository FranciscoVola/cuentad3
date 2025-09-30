<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Mail\ProductoComprado;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    public function agregar($id)
    {
        $producto = Producto::findOrFail($id);
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen,
            ];
        }

        session(['carrito' => $carrito]);
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function quitar($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session(['carrito' => $carrito]);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto quitado del carrito.');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado.');
    }

    public function finalizar()
    {
        $user = Auth::user();
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        $compra = Compra::create([
            'user_id' => $user->id,
            'total' => 0, // temporal
        ]);

        $total = 0;

        foreach ($carrito as $productoId => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;

            DetalleCompra::create([
                'compra_id' => $compra->id,
                'producto_id' => $productoId,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        $compra->update(['total' => $total]);

        // Enviar el mail de confirmación
        Mail::to($user->email)->send(new ProductoComprado($compra));

        // Vaciar carrito
        session()->forget('carrito');

        return redirect()->route('home')->with('success', 'Compra realizada con éxito. Revisa tu correo.');
    }
}
