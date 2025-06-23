<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noticias = Noticia::orderBy('fecha', 'desc')->get();
        return view('admin.noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'titulo' => 'required|string|max:255',
        'contenido' => 'required',
        'fecha' => 'nullable|date',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
        $rutaImagen = $request->file('imagen')->store('noticias', 'public');
        }

     Noticia::create([
        'titulo' => $request->titulo,
        'contenido' => $request->contenido,
        'fecha' => $request->fecha,
        'imagen' => $rutaImagen,
    ]);
        return redirect()->route('noticias.index')->with('success', 'Noticia creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('admin.noticias.edit', compact('noticia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
        'titulo' => 'required|string|max:255',
        'contenido' => 'required',
        'fecha' => 'nullable|date',
    ]);

    $noticia = Noticia::findOrFail($id);
    $noticia->update($request->all());

    return redirect()->route('noticias.index')->with('success', 'Noticia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $noticia = Noticia::findOrFail($id);
        $noticia->delete();

    return redirect()->route('noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }
}
