<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    public function index()
    {
        $datos['empleados'] = Empleado::paginate(5);
        return view('empleado.index', $datos);
    }

    public function create()
    {
        return view('empleado.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre'          => 'required',
            'ApellidoPaterno' => 'required',
            'ApellidoMaterno' => 'required',
            'correo'          => 'required|email',
            'Foto'            => 'required|image',
        ]);

        $datosEmpleado = $request->except('_token');

        if ($request->hasFile('Foto')) {
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        Empleado::insert($datosEmpleado);

        return redirect('empleado')->with('mensaje', 'Empleado agregado con éxito');
    }

    public function show(Empleado $empleado)
    {
        //
    }

    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre'          => 'required',
            'ApellidoPaterno' => 'required',
            'ApellidoMaterno' => 'required',
            'correo'          => 'required|email',
            'Foto'            => 'nullable|image',
        ]);

        $datosEmpleado = $request->except(['_token', '_method']);

        if ($request->hasFile('Foto')) {
            // Eliminar foto anterior
            $empleado = Empleado::findOrFail($id);
            if ($empleado->Foto) {
                Storage::disk('public')->delete($empleado->Foto);
            }
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
        } else {
            unset($datosEmpleado['Foto']);
        }

        Empleado::where('id', $id)->update($datosEmpleado);

        return redirect('empleado')->with('mensaje', 'Registro modificado con éxito');
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        if ($empleado->Foto) {
            Storage::disk('public')->delete($empleado->Foto);
        }
        Empleado::destroy($id);
        return redirect('empleado')->with('mensaje', 'Empleado eliminado');
    }
}