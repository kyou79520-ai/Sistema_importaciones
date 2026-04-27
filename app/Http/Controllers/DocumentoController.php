<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Importacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function store(Request $request, Importacion $importacion)
    {
        $request->validate([
            'tipo_documento' => 'required|in:factura,pedimento,BL,packing_list,certificado_origen,otro',
            'archivo'        => 'required|file|max:20480',
        ]);

        $ruta = $request->file('archivo')->store('documentos/' . $importacion->id_importacion, 'public');

        Documento::create([
            'id_importacion'  => $importacion->id_importacion,
            'id_usuario_sube' => auth()->id(),
            'tipo_documento'  => $request->tipo_documento,
            'ruta_archivo'    => $ruta,
            'validado'        => false,
        ]);

        return back()->with('mensaje', 'Documento cargado correctamente.');
    }

    public function validar(Documento $documento)
    {
        $documento->update([
            'validado'          => true,
            'id_usuario_valida' => auth()->id(),
            'fecha_validacion'  => now(),
        ]);
        return back()->with('mensaje', 'Documento validado.');
    }

    public function destroy(Documento $documento)
    {
        Storage::disk('public')->delete($documento->ruta_archivo);
        $documento->delete();
        return back()->with('mensaje', 'Documento eliminado.');
    }
}