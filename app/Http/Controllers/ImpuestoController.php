<?php

use App\Models\Impuesto;
 
class ImpuestoController extends Controller
{
    public function store(Request $request, Importacion $importacion)
    {
        $request->validate([
            'tipo_impuesto'  => 'required',
            'base_imponible' => 'required|numeric|min:0',
            'tasa_porcentaje'=> 'required|numeric|min:0|max:100',
        ]);
 
        $monto = $request->base_imponible * ($request->tasa_porcentaje / 100);
 
        Impuesto::create([
            'id_importacion'  => $importacion->id_importacion,
            'tipo_impuesto'   => $request->tipo_impuesto,
            'base_imponible'  => $request->base_imponible,
            'tasa_porcentaje' => $request->tasa_porcentaje / 100,
            'monto'           => $monto,
        ]);
 
        // Actualizar total en importación
        $total = $importacion->impuestos()->sum('monto');
        $importacion->update(['total_impuestos' => $total]);
 
        return back()->with('mensaje', 'Impuesto agregado. Monto: $'.number_format($monto, 2));
    }
 
    public function destroy(Impuesto $impuesto)
    {
        $importacion = $impuesto->importacion;
        $impuesto->delete();
        $total = $importacion->impuestos()->sum('monto');
        $importacion->update(['total_impuestos' => $total]);
        return back()->with('mensaje', 'Impuesto eliminado.');
    }
}