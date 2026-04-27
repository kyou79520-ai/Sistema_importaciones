<?php

namespace App\Http\Controllers;

use App\Models\ItemImportacion;
use App\Models\Importacion;
use Illuminate\Http\Request;

class ItemImportacionController extends Controller
{
    public function store(Request $request, Importacion $importacion)
    {
        $request->validate([
            'descripcion'    => 'required|string|max:255',
            'cantidad'       => 'required|numeric|min:0.0001',
            'valor_unitario' => 'required|numeric|min:0',
            'unidad_medida'  => 'required|string|max:20',
            'peso_kg'        => 'nullable|numeric|min:0',
            'codigo_hs'      => 'nullable|string|max:20',
        ]);

        $ultimo      = $importacion->items()->max('numero_linea') ?? 0;
        $valorTotal  = round($request->cantidad * $request->valor_unitario, 2);

        ItemImportacion::create([
            'id_importacion' => $importacion->id_importacion,
            'numero_linea'   => $ultimo + 1,
            'descripcion'    => $request->descripcion,
            'cantidad'       => $request->cantidad,
            'unidad_medida'  => $request->unidad_medida,
            'valor_unitario' => $request->valor_unitario,
            'valor_total'    => $valorTotal,          // ← ahora se guarda
            'peso_kg'        => $request->peso_kg,
            'codigo_hs'      => $request->codigo_hs,
        ]);

        // Actualizar total_cif en la importación
        $totalCif = $importacion->items()->sum('valor_total');
        $importacion->update(['total_cif' => $totalCif]);

        return back()->with('mensaje', 'Partida agregada. Total CIF actualizado: $' . number_format($totalCif, 2));
    }

    public function destroy(ItemImportacion $item)
    {
        $importacion = $item->importacion;
        $item->delete();

        // Renumerar líneas
        $importacion->items()->orderBy('numero_linea')->each(function ($it, $idx) {
            $it->update(['numero_linea' => $idx + 1]);
        });

        // Actualizar total_cif
        $totalCif = $importacion->items()->sum('valor_total');
        $importacion->update(['total_cif' => $totalCif]);

        return back()->with('mensaje', 'Partida eliminada y líneas renumeradas.');
    }
}