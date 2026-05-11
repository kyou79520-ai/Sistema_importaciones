<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * NOTA: La tabla `costo_importacion` no existe en tu base de datos actual.
 * Para usar este modelo, ejecuta la migración 2026_04_29_000001_create_modulos_extra_tables.php
 */
class CostoImportacion extends Model
{
    protected $table = 'costo_importacion';
    protected $primaryKey = 'id_costo';

    public $timestamps = false;

    protected $fillable = [
        'id_importacion', 'concepto', 'monto', 'moneda', 'descripcion'
    ];

    protected $casts = ['monto' => 'decimal:2'];

    public function importacion()
    {
        return $this->belongsTo(Importacion::class, 'id_importacion', 'id_importacion');
    }
}
