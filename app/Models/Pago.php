<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * NOTA: La tabla `pago` no existe en tu base de datos actual.
 * Para usar este modelo, ejecuta la migración 2026_04_29_000001_create_modulos_extra_tables.php
 */
class Pago extends Model
{
    protected $table = 'pago';
    protected $primaryKey = 'id_pago';

    public $timestamps = false;

    protected $fillable = [
        'id_importacion', 'id_usuario', 'monto', 'fecha_pago',
        'metodo_pago', 'num_comprobante', 'moneda'
    ];

    protected $casts = [
        'fecha_pago' => 'date',
        'monto'      => 'decimal:2',
    ];

    public function importacion()
    {
        return $this->belongsTo(Importacion::class, 'id_importacion', 'id_importacion');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
