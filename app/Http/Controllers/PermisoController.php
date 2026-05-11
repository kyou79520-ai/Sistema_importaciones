<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index()
    {
        $permisos = Permiso::orderBy('modulo')->orderBy('nombre')->paginate(15);
        return view('permiso.index', compact('permisos'));
    }

    public function create()
    {
        return view('permiso.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|unique:permiso|max:100',
            'modulo'      => 'required|max:100',
            'descripcion' => 'nullable|max:255',
        ]);

        Permiso::create($request->only('nombre', 'modulo', 'descripcion'));

        return redirect()->route('permiso.index')->with('mensaje', 'Permiso creado.');
    }

    public function edit(Permiso $permiso)
    {
        return view('permiso.edit', compact('permiso'));
    }

    public function update(Request $request, Permiso $permiso)
    {
        $request->validate([
            'nombre'      => 'required|max:100|unique:permiso,nombre,' . $permiso->id_permiso . ',id_permiso',
            'modulo'      => 'required|max:100',
            'descripcion' => 'nullable|max:255',
        ]);

        $permiso->update($request->only('nombre', 'modulo', 'descripcion'));

        return redirect()->route('permiso.index')->with('mensaje', 'Permiso actualizado.');
    }

    public function destroy(Permiso $permiso)
    {
        $permiso->delete();
        return redirect()->route('permiso.index')->with('mensaje', 'Permiso eliminado.');
    }
}