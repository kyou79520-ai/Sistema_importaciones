<?php

class Auditoria extends Model {
    public $timestamps = false;
    protected $table = 'auditoria';
    protected $primaryKey = 'id_auditoria';
    protected $fillable = [
        'id_usuario','accion','tabla_afectada',
        'valores_anteriores','valores_nuevos','ip_address','fecha_hora'
    ];
    protected $casts = [
        'valores_anteriores' => 'array',
        'valores_nuevos'     => 'array',
        'fecha_hora'         => 'datetime',
    ];
    public function usuario() { return $this->belongsTo(Usuario::class, 'id_usuario'); }
}