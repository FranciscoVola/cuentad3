<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Luchador;
use Illuminate\Http\Request;

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
