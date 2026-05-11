<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgenteAduanal extends Model
{
    protected $table = 'agente_aduanal';
    protected $primaryKey = 'id_agente';

    public $timestamps = false;

    protected $fillable = [
        'nombre_agente', 'num_patente', 'aduana_adscrita',
        'telefono', 'RFC_agente'
    ];

    public function importaciones()
    {
        return $this->belongsToMany(
            Importacion::class,
            'importacion_agente',
            'id_agente',
            'id_importacion'
        )->withPivot('asignado_en');
    }
}
