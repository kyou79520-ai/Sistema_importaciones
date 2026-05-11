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
            'tipo_costo'       => 'required|in:flete,seguro,gastos_aduanales,honorarios,almacenaje,otro',
            'seguro'           => 'nullable|numeric|min:0',
            'gastos_aduanales' => 'nullable|numeric|min:0',
            'otros_gastos'     => 'nullable|numeric|min:0',
            'moneda'           => 'nullable|string|max:10',
        ]);

        $seguro    = $request->seguro           ?? 0;
        $aduanales = $request->gastos_aduanales ?? 0;
        $otros     = $request->otros_gastos     ?? 0;
        $total     = $seguro + $aduanales + $otros;

        CostoImportacion::create([
            'id_importacion'   => $importacion->id_importacion,
            'tipo_costo'       => $request->tipo_costo,
            'seguro'           => $seguro,
            'gastos_aduanales' => $aduanales,
            'otros_gastos'     => $otros,
            'total_costos'     => $total,
            'moneda'           => $request->moneda ?? 'MXN',
        ]);

        // Actualizar total_aduanales en la importación
        $totalAduanales = $importacion->costos()->sum('total_costos');
        $importacion->update(['total_aduanales' => $totalAduanales]);

        return back()->with('mensaje', 'Costo agregado correctamente. Total: $' . number_format($total, 2));
    }

    public function destroy(CostoImportacion $costo)
    {
        $importacion = $costo->importacion;
        $costo->delete();

        $totalAduanales = $importacion->costos()->sum('total_costos');
        $importacion->update(['total_aduanales' => $totalAduanales]);

        return back()->with('mensaje', 'Costo eliminado.');
    }
}