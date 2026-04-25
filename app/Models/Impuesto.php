<?php

class Impuesto extends Model {
    protected $table = 'impuesto';
    protected $primaryKey = 'id_impuesto';
    protected $fillable = ['id_importacion','tipo_impuesto','base_imponible','tasa_porcentaje','monto'];
 
    public function importacion() { return $this->belongsTo(Importacion::class, 'id_importacion'); }
}