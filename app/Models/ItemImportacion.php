<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemImportacion extends Model
{
    protected $table = 'item_importacion';
    protected $primaryKey = 'id_item';

    /**
     * Esta tabla SÍ tiene created_at/updated_at según el SQL.
     */
    public $timestamps = true;

    /**
     * IMPORTANTE: valor_total es una columna GENERATED ALWAYS AS STORED.
     * MariaDB la calcula automáticamente. NO la incluimos en fillable.
     */
    protected $fillable = [
        'id_importacion', 'numero_linea', 'descripcion',
        'cantidad', 'valor_unitario', 'peso_kg',
        'codigo_hs', 'unidad_medida'
    ];

    protected $casts = [
        'cantidad'       => 'decimal:2',
        'valor_unitario' => 'decimal:2',
        'valor_total'    => 'decimal:2',
        'peso_kg'        => 'decimal:2',
    ];

    public function importacion()
    {
        return $this->belongsTo(Importacion::class, 'id_importacion', 'id_importacion');
    }

    public function impuestos()
    {
        return $this->hasMany(Impuesto::class, 'id_item', 'id_item');
    }
}
