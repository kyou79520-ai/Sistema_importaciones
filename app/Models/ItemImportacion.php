<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemImportacion extends Model
{
    protected $table = 'item_importacion';
    protected $primaryKey = 'id_item';

    protected $fillable = [
        'id_importacion', 'numero_linea', 'descripcion',
        'cantidad', 'unidad_medida', 'valor_unitario',
        'valor_total', 'peso_kg', 'codigo_hs'
    ];

    protected $casts = [
        'cantidad'       => 'float',
        'valor_unitario' => 'float',
        'valor_total'    => 'float',
    ];

    public function importacion()
    {
        return $this->belongsTo(Importacion::class, 'id_importacion');
    }
}