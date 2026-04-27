<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Http\Request;

// ============================================================
// ARCHIVO: app/Http/Controllers/RolController.php
// ============================================================
class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::withCount(['usuarios', 'permisos'])->paginate(10);
        return view('rol.index', compact('roles'));
    }

    public function create()
    {
        $permisos = Permiso::orderBy('modulo')->orderBy('nombre')->get()->groupBy('modulo');
        return view('rol.create', compact('permisos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|unique:rol|max:100',
            'descripcion' => 'nullable|max:255',
        ]);

        $rol = Rol::create($request->only('nombre', 'descripcion'));

        if ($request->filled('permisos')) {
            $rol->permisos()->sync($request->permisos);
        }

        return redirect()->route('rol.index')->with('mensaje', 'Rol creado correctamente.');
    }

    public function edit(Rol $rol)
    {
        $permisos             = Permiso::orderBy('modulo')->orderBy('nombre')->get();
        $permisosSeleccionados = $rol->permisos->pluck('id_permiso')->toArray();
        return view('rol.edit', compact('rol', 'permisos', 'permisosSeleccionados'));
    }

    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre'      => 'required|max:100|unique:rol,nombre,' . $rol->id_rol . ',id_rol',
            'descripcion' => 'nullable|max:255',
        ]);

        $rol->update($request->only('nombre', 'descripcion'));

        if ($request->has('permisos')) {
            $rol->permisos()->sync($request->permisos ?? []);
        }

        return redirect()->route('rol.index')->with('mensaje', 'Rol actualizado.');
    }

    public function destroy(Rol $rol)
    {
        $rol->delete();
        return redirect()->route('rol.index')->with('mensaje', 'Rol eliminado.');
    }
}