<?php

class EmpresaExtranjera extends Model {
    protected $table = 'empresa_extranjera';
    protected $primaryKey = 'id_empresa';
    protected $fillable = ['nombre_empresa','pais_origen','contacto','moneda_default','num_tax_id'];
 
    public function importaciones() {
        return $this->hasMany(Importacion::class, 'id_empresa_extranjera');
    }
}