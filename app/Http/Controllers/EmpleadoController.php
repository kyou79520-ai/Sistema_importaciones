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
    $empleado = new Empleado();
    return view('empleado.create', compact('empleado'));
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
    $empleado = Empleado::findOrFail($id);
    $datosEmpleado = $request->except(['_token', '_method']);

    if ($request->hasFile('Foto')) {
        $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
    } else {
        unset($datosEmpleado['Foto']);
    }

    $empleado->update($datosEmpleado);

    return redirect('empleado')->with('success', 'Empleado actualizado');
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