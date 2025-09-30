<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::orderBy('fecha', 'desc')->get();
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        // Validación de datos con mensajes personalizados
        $request->validate([
            'titulo' => 'required|string|min:3|max:255',
            'contenido' => 'required|string|min:10',
            'fecha' => 'nullable|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 3 caracteres.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'contenido.required' => 'El contenido es obligatorio.',
            'contenido.min' => 'El contenido debe tener al menos 10 caracteres.',
            'fecha.date' => 'La fecha debe tener un formato válido.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, webp o svg.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ]);

        $datos = $request->only(['titulo', 'contenido']);
        $datos['fecha'] = now(); //para q la fecha nunca se modifique
        $datos['user_id'] = Auth::user()->id; //asigna id al usuario

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('noticias', 'public');
        }

        Noticia::create($datos);

        return redirect()->route('noticias.index')->with('success', 'Noticia creada correctamente.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, string $id)
    {
        // Validación de datos con mensajes personalizados
        $request->validate([
            'titulo' => 'required|string|min:3|max:255',
            'contenido' => 'required|string|min:10',
            'fecha' => 'nullable|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 3 caracteres.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'contenido.required' => 'El contenido es obligatorio.',
            'contenido.min' => 'El contenido debe tener al menos 10 caracteres.',
            'fecha.date' => 'La fecha debe tener un formato válido.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ]);

        $noticia = Noticia::findOrFail($id);
        $datos = $request->only(['titulo', 'contenido', 'fecha']);

        // Si se sube una nueva imagen
        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior si existe
            if ($noticia->imagen && Storage::disk('public')->exists($noticia->imagen)) {
                Storage::disk('public')->delete($noticia->imagen);
            }

            $datos['imagen'] = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia->update($datos);

        return redirect()->route('noticias.index')->with('success', 'Noticia actualizada correctamente.');
    }

    public function confirmDelete($id)
    {
    $noticia = Noticia::findOrFail($id);
    return view('admin.noticias.confirm-delete', compact('noticia'));
    }

    public function destroy(string $id)
    {
        $noticia = Noticia::findOrFail($id);

        // Eliminar imagen asociada si existe
        if ($noticia->imagen && Storage::disk('public')->exists($noticia->imagen)) {
            Storage::disk('public')->delete($noticia->imagen);
        }

        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }
}
