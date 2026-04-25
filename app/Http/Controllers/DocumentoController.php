<?php

use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
 
class DocumentoController extends Controller
{
    public function store(Request $request, Importacion $importacion)
    {
        $request->validate([
            'tipo_documento' => 'required',
            'archivo'        => 'required|file|max:20480', // 20MB
        ]);
 
        $ruta = $request->file('archivo')->store('documentos/'.$importacion->id_importacion, 'public');
 
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
            'validado'         => true,
            'id_usuario_valida'=> auth()->id(),
            'fecha_validacion' => now(),
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