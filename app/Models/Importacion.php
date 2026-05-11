<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Importacion extends Model
{
    protected $table = 'importacion';
    protected $primaryKey = 'id_importacion';

    /**
     * La tabla `importacion` no tiene timestamps.
     */
    public $timestamps = false;

protected $fillable = [
    'numero_importacion', 'id_usuario_creador',
    'id_empresa_mx', 'id_empresa',
    'proveedor', 'pais_origen', 'fecha_arribo', 'estado',
    'total_cif', 'total_impuestos', 'total_aduanales', 'notas'
];

    protected $casts = ['fecha_arribo' => 'date'];

    public function pagos()
{
    return $this->hasMany(Pago::class, 'id_importacion', 'id_importacion');
}

public function costos()
{
    return $this->hasMany(\App\Models\CostoImportacion::class, 'id_importacion', 'id_importacion');
}

    // ─── Relaciones ──────────────────────────────────────────
   public function usuario()
{
    return $this->belongsTo(Usuario::class, 'id_usuario_creador', 'id_usuario');
}

    public function empresaImportadora()
    {
        return $this->belongsTo(EmpresaImportadora::class, 'id_empresa_mx', 'id_empresa_mx');
    }

  public function empresaExtranjera()
{
    return $this->belongsTo(EmpresaExtranjera::class, 'id_empresa', 'id_empresa');
}

    public function items()
    {
        return $this->hasMany(ItemImportacion::class, 'id_importacion', 'id_importacion');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'id_importacion', 'id_importacion');
    }

    /**
     * Los impuestos están a nivel de item, no de importación.
     * Esta relación va a través de los items.
     */
    public function impuestos()
    {
        return $this->hasManyThrough(
            Impuesto::class,
            ItemImportacion::class,
            'id_importacion', // FK en items
            'id_item',         // FK en impuesto
            'id_importacion',  // PK en importacion
            'id_item'          // PK en items
        );
    }

   public function agentes()
{
    return $this->belongsToMany(
        AgenteAduanal::class,
        'importacion_agente',
        'id_importacion',
        'id_agente'
    )->withPivot('fecha_asignacion');
}

    // ─── Accessors ──────────────────────────────────────────
    public function getEstadoLabelAttribute(): string
    {
        return match (strtolower($this->estado ?? '')) {
            'borrador'   => 'Borrador',
            'en_tramite' => 'En Trámite',
            'en_aduana'  => 'En Aduana',
            'liberada'   => 'Liberada',
            'entregada'  => 'Entregada',
            'cancelada'  => 'Cancelada',
            'en proceso' => 'En Proceso',
            default      => $this->estado ?? '—',
        };
    }

    public function getEstadoColorAttribute(): string
    {
        return match (strtolower($this->estado ?? '')) {
            'borrador'   => 'secondary',
            'en_tramite' => 'info',
            'en_aduana'  => 'warning',
            'liberada'   => 'primary',
            'entregada'  => 'success',
            'cancelada'  => 'danger',
            'en proceso' => 'info',
            default      => 'light',
        };
    }
}
