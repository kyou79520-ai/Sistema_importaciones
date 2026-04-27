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
        $roles = Rol::orderBy('nombre')->get();
        return view('usuario.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_usuario'  => 'required|unique:usuario|max:50',
            'nombre_completo' => 'required|max:150',
            'email'           => 'required|email|unique:usuario',
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
        ]);

        if ($request->filled('roles')) {
            $usuario->roles()->sync($request->roles);
        }

        return redirect()->route('usuario.index')->with('mensaje', 'Usuario creado correctamente.');
    }

    public function edit(Usuario $usuario)
    {
        $roles            = Rol::orderBy('nombre')->get();
        $rolesSeleccionados = $usuario->roles->pluck('id_rol')->toArray();
        return view('usuario.edit', compact('usuario', 'roles', 'rolesSeleccionados'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre_usuario'  => 'required|max:50|unique:usuario,nombre_usuario,' . $usuario->id_usuario . ',id_usuario',
            'nombre_completo' => 'required|max:150',
            'email'           => 'required|email|unique:usuario,email,' . $usuario->id_usuario . ',id_usuario',
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
            $usuario->roles()->sync($request->roles);
        }

        return redirect()->route('usuario.index')->with('mensaje', 'Usuario actualizado.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuario.index')->with('mensaje', 'Usuario eliminado.');
    }
}