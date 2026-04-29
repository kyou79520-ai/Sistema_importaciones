<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';
    protected $primaryKey = 'id_documento';

    public $timestamps = false;

    protected $fillable = [
        'id_importacion', 'id_usuario_subida', 'id_usuario_validador',
        'tipo_documento', 'ruta_archivo', 'fecha_subida',
        'validado', 'fecha_validacion'
    ];

    protected $casts = [
        'validado'         => 'boolean',
        'fecha_subida'     => 'datetime',
        'fecha_validacion' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($doc) {
            if (empty($doc->fecha_subida)) {
                $doc->fecha_subida = now();
            }
        });
    }

    public function importacion()
    {
        return $this->belongsTo(Importacion::class, 'id_importacion', 'id_importacion');
    }

    public function usuarioSube()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_subida', 'id_usuario');
    }

    public function usuarioValida()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_validador', 'id_usuario');
    }
}
