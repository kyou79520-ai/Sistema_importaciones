<?php

namespace App\Http\Controllers;
 
use App\Models\Importacion;
use App\Models\EmpresaExtranjera;
use App\Models\EmpresaImportadora;
use App\Models\AgenteAduanal;
use App\Models\Usuario;
use Illuminate\Http\Request;
 
class ImportacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Importacion::with(['usuario','empresaImportadora','empresaExtranjera']);
 
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        if ($request->filled('buscar')) {
            $query->where('numero_importacion', 'like', '%'.$request->buscar.'%');
        }
 
        $importaciones = $query->orderByDesc('created_at')->paginate(10);
        return view('importacion.index', compact('importaciones'));
    }
 
    public function create()
    {
        $empresasExtranjeras = EmpresaExtranjera::orderBy('nombre_empresa')->get();
        $empresasImportadoras = EmpresaImportadora::orderBy('razon_social')->get();
        $agentes = AgenteAduanal::orderBy('nombre_agente')->get();
        return view('importacion.create', compact('empresasExtranjeras','empresasImportadoras','agentes'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'numero_importacion'    => 'required|unique:importacion',
            'pais_origen'           => 'required',
            'id_empresa_extranjera' => 'nullable|exists:empresa_extranjera,id_empresa',
            'id_empresa_mx'         => 'nullable|exists:empresa_importadora,id_empresa_mx',
            'fecha_arribo'          => 'nullable|date',
        ]);
 
        $importacion = Importacion::create([
            'numero_importacion'    => $request->numero_importacion,
            'id_usuario'            => auth()->id(), // ajustar si usas tabla usuario propia
            'id_empresa_mx'         => $request->id_empresa_mx,
            'id_empresa_extranjera' => $request->id_empresa_extranjera,
            'proveedor'             => $request->proveedor,
            'pais_origen'           => $request->pais_origen,
            'fecha_arribo'          => $request->fecha_arribo,
            'estado'                => 'borrador',
            'notas'                 => $request->notas,
        ]);
 
        if ($request->filled('agentes')) {
            $importacion->agentes()->sync($request->agentes);
        }
 
        return redirect()->route('importacion.show', $importacion->id_importacion)
                         ->with('mensaje', 'Importación creada correctamente.');
    }
 
    public function show(Importacion $importacion)
    {
        $importacion->load([
            'items','documentos','impuestos','costos','pagos',
            'agentes','empresaImportadora','empresaExtranjera','usuario'
        ]);
        return view('importacion.show', compact('importacion'));
    }
 
    public function edit(Importacion $importacion)
    {
        $empresasExtranjeras  = EmpresaExtranjera::orderBy('nombre_empresa')->get();
        $empresasImportadoras = EmpresaImportadora::orderBy('razon_social')->get();
        $agentes              = AgenteAduanal::orderBy('nombre_agente')->get();
        $agentesSeleccionados = $importacion->agentes->pluck('id_agente')->toArray();
        return view('importacion.edit', compact(
            'importacion','empresasExtranjeras','empresasImportadoras','agentes','agentesSeleccionados'
        ));
    }
 
    public function update(Request $request, Importacion $importacion)
    {
        $request->validate([
            'numero_importacion' => 'required|unique:importacion,numero_importacion,'.$importacion->id_importacion.',id_importacion',
            'pais_origen'        => 'required',
            'fecha_arribo'       => 'nullable|date',
        ]);
 
        $importacion->update($request->except(['_token','_method','agentes']));
 
        if ($request->has('agentes')) {
            $importacion->agentes()->sync($request->agentes);
        }
 
        return redirect()->route('importacion.show', $importacion->id_importacion)
                         ->with('mensaje', 'Importación actualizada.');
    }
 
    public function destroy(Importacion $importacion)
    {
        $importacion->delete();
        return redirect()->route('importacion.index')->with('mensaje', 'Importación eliminada.');
    }
 
    public function cambiarEstado(Request $request, Importacion $importacion)
    {
        $estados = ['borrador','en_tramite','en_aduana','liberada','entregada','cancelada'];
        $request->validate(['estado' => 'required|in:'.implode(',', $estados)]);
        $importacion->update(['estado' => $request->estado]);
        return back()->with('mensaje', 'Estado actualizado a: '.$importacion->fresh()->estado_label);
    }
}