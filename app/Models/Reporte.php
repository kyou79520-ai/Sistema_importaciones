<?php

class Reporte extends Model {
    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';
    protected $fillable = ['id_usuario','nombre_reporte','titulo','ruta_archivo','formato','parametros'];
    protected $casts = ['parametros' => 'array'];
 
    public function usuario() { return $this->belongsTo(Usuario::class, 'id_usuario'); }
}