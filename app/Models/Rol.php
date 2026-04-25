<?php


class Rol extends Model {
    protected $table = 'rol';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['nombre','descripcion'];
 
    public function permisos() {
        return $this->belongsToMany(Permiso::class, 'rol_permiso', 'id_rol', 'id_permiso')
                    ->withPivot('asignado_en');
    }
    public function usuarios() {
        return $this->belongsToMany(Usuario::class, 'usuario_rol', 'id_rol', 'id_usuario')
                    ->withPivot('asignado_en');
    }
}