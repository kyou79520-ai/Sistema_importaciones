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

    protected $fillable = [
        'nombre_usuario', 'hash_contrasena', 'nombre_completo',
        'email', 'telefono', 'RFC', 'activo', 'ultimo_acceso'
    ];

    protected $hidden = ['hash_contrasena', 'remember_token'];

    protected $casts = [
        'activo'        => 'boolean',
        'ultimo_acceso' => 'datetime',
    ];

    /**
     * Laravel Auth busca por defecto la columna 'password'.
     * Le decimos que la contraseña real está en 'hash_contrasena'.
     */
    public function getAuthPassword()
    {
        return $this->hash_contrasena;
    }

    /**
     * Permite asignar 'password' como atributo y se guardará automáticamente
     * hasheado en 'hash_contrasena'. Útil para registro y reset.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['hash_contrasena'] = Hash::make($value);
    }

    /**
     * Para que las notificaciones (reset password, etc.) sepan a dónde enviar el email.
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    // ─── Relaciones ──────────────────────────────────────────
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'usuario_rol', 'id_usuario', 'id_rol')
                    ->withPivot('asignado_en');
    }

    public function importaciones()
    {
        return $this->hasMany(Importacion::class, 'id_usuario');
    }

    public function documentosSubidos()
    {
        return $this->hasMany(Documento::class, 'id_usuario_sube');
    }

    public function documentosValidados()
    {
        return $this->hasMany(Documento::class, 'id_usuario_valida');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_usuario');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_usuario');
    }

    public function auditorias()
    {
        return $this->hasMany(Auditoria::class, 'id_usuario');
    }

    // ─── Helpers de roles/permisos ──────────────────────────
    public function tieneRol(string $nombreRol): bool
    {
        return $this->roles()->where('nombre', $nombreRol)->exists();
    }

    public function tienePermiso(string $nombrePermiso): bool
    {
        return $this->roles()
            ->whereHas('permisos', fn($q) => $q->where('nombre', $nombrePermiso))
            ->exists();
    }
}