<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Luchador;
use Illuminate\Http\Request;

class LuchadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $luchadores = Luchador::all();
        return view('admin.luchadores.index', compact('luchadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.luchadores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nombre' => 'required|string|max:255',
        'alias' => 'nullable|string|max:255',
        'peso' => 'nullable|string|max:50',
        'altura' => 'nullable|string|max:50',
        'ciudad_origen' => 'nullable|string|max:255',
        'biografia' => 'nullable|string',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/luchadores'), $filename);
        $data['imagen'] = 'uploads/luchadores/' . $filename;
    }

    Luchador::create($data);

    return redirect()->route('luchadores.index')->with('success', 'Luchador agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Luchador $luchador, $id)
    {
        $luchador = Luchador::findOrFail($id);
        return view('luchadores.detalle', compact('luchador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $luchador = Luchador::findOrFail($id);
        return view('admin.luchadores.edit', compact('luchador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $luchador = Luchador::findOrFail($id);

          $request->validate([
        'nombre' => 'required|string|max:255',
        'alias' => 'nullable|string|max:255',
        'peso' => 'nullable|string|max:50',
        'altura' => 'nullable|string|max:50',
        'ciudad_origen' => 'nullable|string|max:255',
        'biografia' => 'nullable|string',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/luchadores'), $filename);
        $data['imagen'] = 'uploads/luchadores/' . $filename;
    }

    $luchador->update($data);

    return redirect()->route('luchadores.index')->with('success', 'Luchador actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $luchador = Luchador::findOrFail($id);
        if ($luchador->imagen && file_exists(public_path($luchador->imagen))) {
        unlink(public_path($luchador->imagen));
    }

    $luchador->delete();

    return redirect()->route('luchadores.index')->with('success', 'Luchador eliminado correctamente.');
    }
}
