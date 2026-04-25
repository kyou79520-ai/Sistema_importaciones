<?php



class Permiso extends Model {
    protected $table = 'permiso';
    protected $primaryKey = 'id_permiso';
    protected $fillable = ['nombre','descripcion','modulo'];
 
    public function roles() {
        return $this->belongsToMany(Rol::class, 'rol_permiso', 'id_permiso', 'id_rol')
                    ->withPivot('asignado_en');
    }
}