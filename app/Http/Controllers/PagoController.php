<?php

use App\Models\Pago;
 
class PagoController extends Controller
{
    public function store(Request $request, Importacion $importacion)
    {
        $request->validate([
            'monto'       => 'required|numeric|min:0.01',
            'fecha_pago'  => 'required|date',
            'metodo_pago' => 'required',
        ]);
 
        Pago::create([
            'id_importacion'  => $importacion->id_importacion,
            'id_usuario'      => auth()->id(),
            'monto'           => $request->monto,
            'fecha_pago'      => $request->fecha_pago,
            'metodo_pago'     => $request->metodo_pago,
            'num_comprobante' => $request->num_comprobante,
            'moneda'          => $request->moneda ?? 'MXN',
        ]);
 
        return back()->with('mensaje', 'Pago registrado.');
    }
}