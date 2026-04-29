<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Http\Request;

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
            'nombre_rol'  => 'required|unique:rol,nombre_rol|max:50',
            'descripcion' => 'nullable',
        ]);

        $rol = Rol::create([
            'nombre_rol'  => $request->nombre_rol,
            'descripcion' => $request->descripcion,
        ]);

        if ($request->filled('permisos')) {
            $datos = collect($request->permisos)
                ->mapWithKeys(fn($id) => [$id => ['asignado_en' => now()]])
                ->toArray();
            $rol->permisos()->sync($datos);
        }

        return redirect()->route('rol.index')->with('mensaje', 'Rol creado correctamente.');
    }

    public function edit(Rol $rol)
    {
        $permisos              = Permiso::orderBy('modulo')->orderBy('nombre')->get();
        $permisosSeleccionados = $rol->permisos->pluck('id_permiso')->toArray();
        return view('rol.edit', compact('rol', 'permisos', 'permisosSeleccionados'));
    }

    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre_rol'  => 'required|max:50|unique:rol,nombre_rol,'.$rol->id_rol.',id_rol',
            'descripcion' => 'nullable',
        ]);

        $rol->update([
            'nombre_rol'  => $request->nombre_rol,
            'descripcion' => $request->descripcion,
        ]);

        if ($request->has('permisos')) {
            $datos = collect($request->permisos ?? [])
                ->mapWithKeys(fn($id) => [$id => ['asignado_en' => now()]])
                ->toArray();
            $rol->permisos()->sync($datos);
        }

        return redirect()->route('rol.index')->with('mensaje', 'Rol actualizado.');
    }

    public function destroy(Rol $rol)
    {
        $rol->delete();
        return redirect()->route('rol.index')->with('mensaje', 'Rol eliminado.');
    }
}
