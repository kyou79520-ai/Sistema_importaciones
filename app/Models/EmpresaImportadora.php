<?php

class EmpresaImportadora extends Model {
    protected $table = 'empresa_importadora';
    protected $primaryKey = 'id_empresa_mx';
    protected $fillable = ['RFC_empresa','razon_social','padron_importadores','giro_comercial'];
    protected $casts = ['padron_importadores' => 'boolean'];
 
    public function importaciones() {
        return $this->hasMany(Importacion::class, 'id_empresa_mx');
    }
}