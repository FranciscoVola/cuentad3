<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrada;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EntradaAdminController extends Controller
{
    public function index()
    {
        $entradas = Entrada::orderBy('created_at', 'desc')->get();
        return view('admin.entradas.index', compact('entradas'));
    }

    public function create()
    {
        return view('admin.entradas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'evento' => 'required|string|min:3|max:255',
            'fecha' => 'nullable|date',
            'hora' => 'nullable|date_format:H:i',
            'lugar' => 'nullable|string|max:255',
            'precio' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $datos = $request->only(['evento', 'fecha', 'hora', 'lugar', 'precio']);
        $datos['codigo'] = strtoupper(Str::random(10));
        $datos['user_id'] = Auth::id();

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('entradas', 'public');
        }

        Entrada::create($datos);

        return redirect()->route('entradas-admin.index')->with('success', 'Entrada creada correctamente.');
    }

    public function edit($id)
    {
        $entrada = Entrada::findOrFail($id);
        return view('admin.entradas.edit', compact('entrada'));
    }

    public function update(Request $request, $id)
    {
        $entrada = Entrada::findOrFail($id);

        $request->validate([
            'evento' => 'required|string|min:3|max:255',
            'fecha' => 'nullable|date',
            'hora' => 'nullable|date_format:H:i',
            'lugar' => 'nullable|string|max:255',
            'precio' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $datos = $request->only(['evento', 'fecha', 'hora', 'lugar', 'precio']);

        if ($request->hasFile('imagen')) {
            if ($entrada->imagen && Storage::disk('public')->exists($entrada->imagen)) {
                Storage::disk('public')->delete($entrada->imagen);
            }

            $datos['imagen'] = $request->file('imagen')->store('entradas', 'public');
        }

        $entrada->update($datos);

        return redirect()->route('entradas-admin.index')->with('success', 'Entrada actualizada correctamente.');
    }

    public function confirmDelete($id)
    {
        $entrada = Entrada::findOrFail($id);
        return view('admin.entradas.confirm-delete', compact('entrada'));
    }

    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);

        if ($entrada->imagen && Storage::disk('public')->exists($entrada->imagen)) {
            Storage::disk('public')->delete($entrada->imagen);
        }

        $entrada->delete();

        return redirect()->route('entradas-admin.index')->with('success', 'Entrada eliminada correctamente.');
    }
}
