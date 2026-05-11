<?php

namespace App\Http\Controllers;

use App\Models\CostoImportacion;
use App\Models\Importacion;
use Illuminate\Http\Request;

class CostoImportacionController extends Controller
{
    public function store(Request $request, Importacion $importacion)
{
    $request->validate([
        'concepto'    => 'required|string|max:255',
        'monto'       => 'required|numeric|min:0',
        'moneda'      => 'nullable|string|max:10',
        'descripcion' => 'nullable|string',
    ]);

    CostoImportacion::create([
        'id_importacion' => $importacion->id_importacion,
        'concepto'       => $request->concepto,
        'monto'          => $request->monto,
        'moneda'         => $request->moneda ?? 'MXN',
        'descripcion'    => $request->descripcion,
    ]);

    $totalAduanales = $importacion->costos()->sum('monto');
    $importacion->update(['total_aduanales' => $totalAduanales]);

    return back()->with('mensaje', 'Costo agregado correctamente.');
}

    public function destroy(CostoImportacion $costoImportacion)
{
    $importacion = $costoImportacion->importacion;
    $costoImportacion->delete();

    $totalAduanales = $importacion->costos()->sum('monto');
    $importacion->update(['total_aduanales' => $totalAduanales]);

    return back()->with('mensaje', 'Costo eliminado.');
}
}