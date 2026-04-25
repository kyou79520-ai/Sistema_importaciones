<?php

use App\Models\ItemImportacion;
 
class ItemImportacionController extends Controller
{
    public function store(Request $request, Importacion $importacion)
    {
        $request->validate([
            'descripcion'    => 'required',
            'cantidad'       => 'required|numeric|min:0.0001',
            'valor_unitario' => 'required|numeric|min:0',
            'unidad_medida'  => 'required',
        ]);
 
        $ultimo = $importacion->items()->max('numero_linea') ?? 0;
 
        ItemImportacion::create([
            'id_importacion' => $importacion->id_importacion,
            'numero_linea'   => $ultimo + 1,
            'descripcion'    => $request->descripcion,
            'cantidad'       => $request->cantidad,
            'unidad_medida'  => $request->unidad_medida,
            'valor_unitario' => $request->valor_unitario,
            'peso_kg'        => $request->peso_kg,
            'codigo_hs'      => $request->codigo_hs,
        ]);
 
        return back()->with('mensaje', 'Partida agregada.');
    }
 
    public function destroy(ItemImportacion $item)
    {
        $id = $item->id_importacion;
        $item->delete();
        return back()->with('mensaje', 'Partida eliminada.');
    }
}