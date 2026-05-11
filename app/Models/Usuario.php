<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    /**
     * La tabla `usuario` tiene `fecha_creacion` en lugar de created_at/updated_at.
     */
    public $timestamps = false;

    protected $fillable = [
        'nombre_usuario', 'hash_contrasena', 'nombre_completo',
        'email', 'telefono', 'RFC', 'activo', 'ultimo_acceso',
        'fecha_creacion'
    ];

    protected $hidden = ['hash_contrasena', 'remember_token'];

    protected $casts = [
        'activo'         => 'boolean',
        'ultimo_acceso'  => 'datetime',
        'fecha_creacion' => 'datetime',
    ];

    /**
     * Al crear, llenar fecha_creacion automáticamente.
     */
    protected static function booted(): void
    {
        static::creating(function ($usuario) {
            if (empty($usuario->fecha_creacion)) {
                $usuario->fecha_creacion = now();
            }
        });
    }

    public function getAuthPassword()
    {
        return $this->hash_contrasena;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['hash_contrasena'] = Hash::make($value);
    }

    public function setHashContrasenaAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['hash_contrasena'] = $value;
            return;
        }

        $esBcrypt = preg_match('/^\$2[aby]\$\d{2}\$/', $value) && strlen($value) === 60;
        $this->attributes['hash_contrasena'] = $esBcrypt ? $value : Hash::make($value);
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    // ─── Relaciones ──────────────────────────────────────────
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'usuario_rol', 'id_usuario', 'id_rol')
                    ->withPivot('fecha_asignacion');
    }

    public function importaciones()
    {
        return $this->hasMany(Importacion::class, 'id_usuario_creador', 'id_usuario');
    }

    public function documentosSubidos()
    {
        return $this->hasMany(Documento::class, 'id_usuario_subida', 'id_usuario');
    }

    public function documentosValidados()
    {
        return $this->hasMany(Documento::class, 'id_usuario_validador', 'id_usuario');
    }

    // ─── Helpers de roles/permisos ──────────────────────────
    public function tieneRol(string $nombreRol): bool
    {
        return $this->roles()->where('nombre_rol', $nombreRol)->exists();
    }

    public function tienePermiso(string $nombrePermiso): bool
    {
        return $this->roles()
            ->whereHas('permisos', fn($q) => $q->where('nombre', $nombrePermiso))
            ->exists();
    }
}
