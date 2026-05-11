<?php

namespace App\Observers;

use App\Models\Importacion;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Request;

class ImportacionObserver
{
    public function created(Importacion $importacion): void
    {
        Auditoria::create([
            'id_usuario'      => auth()->id(),
            'accion'          => 'CREATE',
            'tabla_afectada'  => 'importacion',
            'valores_anteriores' => null,
            'valores_nuevos'  => $importacion->toArray(),
            'ip_address'      => Request::ip(),
            'fecha_hora'      => now(),
        ]);
    }

    public function updated(Importacion $importacion): void
    {
        Auditoria::create([
            'id_usuario'         => auth()->id(),
            'accion'             => 'UPDATE',
            'tabla_afectada'     => 'importacion',
            'valores_anteriores' => $importacion->getOriginal(),
            'valores_nuevos'     => $importacion->getDirty(),
            'ip_address'         => Request::ip(),
            'fecha_hora'         => now(),
        ]);
    }

    public function deleted(Importacion $importacion): void
    {
        Auditoria::create([
            'id_usuario'         => auth()->id(),
            'accion'             => 'DELETE',
            'tabla_afectada'     => 'importacion',
            'valores_anteriores' => $importacion->toArray(),
            'valores_nuevos'     => null,
            'ip_address'         => Request::ip(),
            'fecha_hora'         => now(),
        ]);
    }
}