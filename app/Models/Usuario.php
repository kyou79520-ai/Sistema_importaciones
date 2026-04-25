<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class Usuario extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'nombre_usuario','hash_contrasena','nombre_completo',
        'email','telefono','RFC','activo','ultimo_acceso'
    ];
    protected $hidden = ['hash_contrasena'];
    protected $casts = ['activo' => 'boolean', 'ultimo_acceso' => 'datetime'];
 
    public function roles() {
        return $this->belongsToMany(Rol::class, 'usuario_rol', 'id_usuario', 'id_rol')
                    ->withPivot('asignado_en');
    }
    public function importaciones() {
        return $this->hasMany(Importacion::class, 'id_usuario');
    }
    public function documentosSubidos() {
        return $this->hasMany(Documento::class, 'id_usuario_sube');
    }
    public function documentosValidados() {
        return $this->hasMany(Documento::class, 'id_usuario_valida');
    }
    public function pagos() {
        return $this->hasMany(Pago::class, 'id_usuario');
    }
    public function reportes() {
        return $this->hasMany(Reporte::class, 'id_usuario');
    }
    public function auditorias() {
        return $this->hasMany(Auditoria::class, 'id_usuario');
    }
}