<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Luchador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LuchadorController extends Controller
{
    public function index()
    {
        $luchadores = Luchador::all();
        return view('admin.luchadores.index', compact('luchadores'));
    }

    public function create()
    {
        return view('admin.luchadores.create');
    }

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
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpg, jpeg, png o webp.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ]);

        $data = $request->only(['nombre', 'alias', 'peso', 'altura', 'ciudad_origen', 'biografia']);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('luchadores', 'public');
        }

        Luchador::create($data);

        return redirect()->route('luchadores.index')->with('success', 'Luchador agregado correctamente.');
    }

    public function edit($id)
    {
        $luchador = Luchador::findOrFail($id);
        return view('admin.luchadores.edit', compact('luchador'));
    }

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

        $data = $request->only(['nombre', 'alias', 'peso', 'altura', 'ciudad_origen', 'biografia']);

        if ($request->hasFile('imagen')) {
            if ($luchador->imagen && Storage::disk('public')->exists($luchador->imagen)) {
                Storage::disk('public')->delete($luchador->imagen);
            }

            $data['imagen'] = $request->file('imagen')->store('luchadores', 'public');
        }

        $luchador->update($data);

        return redirect()->route('luchadores.index')->with('success', 'Luchador actualizado correctamente.');
    }

    public function confirmDelete($id)
    {
    $luchador = Luchador::findOrFail($id);
    return view('admin.luchadores.confirm-delete', compact('luchador'));
    }


    public function destroy($id)
    {
        $luchador = Luchador::findOrFail($id);

        if ($luchador->imagen && Storage::disk('public')->exists($luchador->imagen)) {
            Storage::disk('public')->delete($luchador->imagen);
        }

        $luchador->delete();

        return redirect()->route('luchadores.index')->with('success', 'Luchador eliminado correctamente.');
    }
}
