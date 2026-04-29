<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'id_rol';

    public $timestamps = false;

    protected $fillable = ['nombre_rol', 'descripcion'];

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'rol_permiso', 'id_rol', 'id_permiso')
                    ->withPivot('asignado_en');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_rol', 'id_rol', 'id_usuario')
                    ->withPivot('fecha_asignacion');
    }

    /**
     * Alias para compatibilidad con código que use 'nombre' en lugar de 'nombre_rol'.
     */
    public function getNombreAttribute()
    {
        return $this->attributes['nombre_rol'] ?? null;
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre_rol'] = $value;
    }
}
