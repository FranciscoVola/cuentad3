<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required',
            'fecha' => 'nullable|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $datos = $request->only(['titulo', 'contenido', 'fecha']);

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
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required',
            'fecha' => 'nullable|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
