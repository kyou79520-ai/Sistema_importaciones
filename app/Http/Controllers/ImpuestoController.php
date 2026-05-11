<?php

namespace App\Http\Controllers;

use App\Models\Impuesto;
use App\Models\Importacion;
use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
public function store(Request $request, Importacion $importacion)
{
    $request->validate([
        'id_item'         => 'required|exists:item_importacion,id_item',
        'tipo_impuesto'   => 'required|in:IGI,IVA,DTA,PRV,IEPS,otro',
        'base_imponible'  => 'required|numeric|min:0',
        'tasa_porcentaje' => 'required|numeric|min:0|max:100',
    ]);

    $monto = round($request->base_imponible * ($request->tasa_porcentaje / 100), 2);

    Impuesto::create([
        'id_item'         => $request->id_item,
        'tipo_impuesto'   => $request->tipo_impuesto,
        'base_imponible'  => $request->base_imponible,
        'tasa_porcentaje' => $request->tasa_porcentaje / 100,
        'monto'           => $monto,
    ]);

    $total = $importacion->impuestos()->sum('monto');
    $importacion->update(['total_impuestos' => $total]);

    return back()->with('mensaje', 'Impuesto agregado. Monto: $' . number_format($monto, 2));
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