<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $table = 'impuesto';
    protected $primaryKey = 'id_impuesto';

    public $timestamps = false;

    /**
     * En tu BD, el impuesto se asocia a un ITEM específico, no a la importación.
     */
    protected $fillable = [
        'id_item', 'tipo_impuesto', 'base_imponible',
        'tasa_porcentaje', 'monto'
    ];

    protected $casts = [
        'base_imponible'  => 'decimal:2',
        'tasa_porcentaje' => 'decimal:2',
        'monto'           => 'decimal:2',
    ];

    public function item()
    {
        return $this->belongsTo(ItemImportacion::class, 'id_item', 'id_item');
    }

    public function importacion()
    {
        return $this->hasOneThrough(
            Importacion::class,
            ItemImportacion::class,
            'id_item',         // FK en items que apunta a importacion
            'id_importacion',  // PK en importacion
            'id_item',         // FK en impuesto
            'id_importacion'   // FK en items
        );
    }
}
