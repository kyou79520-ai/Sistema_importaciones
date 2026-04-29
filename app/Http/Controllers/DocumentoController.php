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
            'tipo_documento' => 'required|string|max:50',
            'archivo'        => 'required|file|max:20480',
        ]);

        $ruta = $request->file('archivo')->store(
            'documentos/' . $importacion->id_importacion,
            'public'
        );

        Documento::create([
            'id_importacion'    => $importacion->id_importacion,
            'id_usuario_subida' => auth()->id(),
            'tipo_documento'    => $request->tipo_documento,
            'ruta_archivo'      => $ruta,
            'fecha_subida'      => now(),
            'validado'          => false,
        ]);

        return back()->with('mensaje', 'Documento cargado correctamente.');
    }

    public function validar(Documento $documento)
    {
        $documento->update([
            'validado'             => true,
            'id_usuario_validador' => auth()->id(),
            'fecha_validacion'     => now(),
        ]);
        return back()->with('mensaje', 'Documento validado.');
    }

    public function destroy(Documento $documento)
    {
        if ($documento->ruta_archivo) {
            Storage::disk('public')->delete($documento->ruta_archivo);
        }
        $documento->delete();
        return back()->with('mensaje', 'Documento eliminado.');
    }
}
