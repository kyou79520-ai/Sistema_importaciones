<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('roles')->paginate(10);
        return view('usuario.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::orderBy('nombre_rol')->get();
        return view('usuario.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_usuario'  => 'required|unique:usuario,nombre_usuario|max:50',
            'nombre_completo' => 'required|max:200',
            'email'           => 'required|email|unique:usuario,email|max:100',
            'password'        => 'required|min:8|confirmed',
            'telefono'        => 'nullable|max:20',
            'RFC'             => 'nullable|max:13',
        ]);

        $usuario = Usuario::create([
            'nombre_usuario'  => $request->nombre_usuario,
            'hash_contrasena' => Hash::make($request->password),
            'nombre_completo' => $request->nombre_completo,
            'email'           => $request->email,
            'telefono'        => $request->telefono,
            'RFC'             => $request->RFC,
            'activo'          => true,
            'fecha_creacion'  => now(),
        ]);

        if ($request->filled('roles')) {
            $datosRoles = collect($request->roles)
                ->mapWithKeys(fn($id) => [$id => ['fecha_asignacion' => now()]])
                ->toArray();
            $usuario->roles()->sync($datosRoles);
        }

        return redirect()->route('usuario.index')->with('mensaje', 'Usuario creado correctamente.');
    }

    public function edit(Usuario $usuario)
    {
        $roles              = Rol::orderBy('nombre_rol')->get();
        $rolesSeleccionados = $usuario->roles->pluck('id_rol')->toArray();
        return view('usuario.edit', compact('usuario', 'roles', 'rolesSeleccionados'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre_usuario'  => 'required|max:50|unique:usuario,nombre_usuario,'.$usuario->id_usuario.',id_usuario',
            'nombre_completo' => 'required|max:200',
            'email'           => 'required|email|max:100|unique:usuario,email,'.$usuario->id_usuario.',id_usuario',
            'password'        => 'nullable|min:8|confirmed',
            'telefono'        => 'nullable|max:20',
            'RFC'             => 'nullable|max:13',
        ]);

        $datos = [
            'nombre_usuario'  => $request->nombre_usuario,
            'nombre_completo' => $request->nombre_completo,
            'email'           => $request->email,
            'telefono'        => $request->telefono,
            'RFC'             => $request->RFC,
            'activo'          => $request->boolean('activo'),
        ];

        if ($request->filled('password')) {
            $datos['hash_contrasena'] = Hash::make($request->password);
        }

        $usuario->update($datos);

        if ($request->has('roles')) {
            $datosRoles = collect($request->roles ?? [])
                ->mapWithKeys(fn($id) => [$id => ['fecha_asignacion' => now()]])
                ->toArray();
            $usuario->roles()->sync($datosRoles);
        }

        return redirect()->route('usuario.index')->with('mensaje', 'Usuario actualizado.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuario.index')->with('mensaje', 'Usuario eliminado.');
    }
}
