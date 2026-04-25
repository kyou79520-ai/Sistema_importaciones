<?php

class LogSistemaExterno extends Model {
    public $timestamps = false;
    protected $table = 'log_sistema_externo';
    protected $primaryKey = 'id_log';
    protected $fillable = [
        'id_importacion','sistema_nombre','tipo_operacion',
        'estado','mensaje_respuesta','fecha_sincronizacion'
    ];
    protected $casts = ['fecha_sincronizacion' => 'datetime'];
    public function importacion() { return $this->belongsTo(Importacion::class, 'id_importacion'); }
}