<?php

class Pago extends Model {
    protected $table = 'pago';
    protected $primaryKey = 'id_pago';
    protected $fillable = [
        'id_importacion','id_usuario','monto','fecha_pago',
        'metodo_pago','num_comprobante','moneda'
    ];
    protected $casts = ['fecha_pago' => 'date'];
 
    public function importacion() { return $this->belongsTo(Importacion::class, 'id_importacion'); }
    public function usuario() { return $this->belongsTo(Usuario::class, 'id_usuario'); }
}