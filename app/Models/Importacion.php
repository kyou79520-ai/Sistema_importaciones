<?php

class Importacion extends Model {
    protected $table = 'importacion';
    protected $primaryKey = 'id_importacion';
    protected $fillable = [
        'numero_importacion','id_usuario','id_empresa_mx','id_empresa_extranjera',
        'proveedor','pais_origen','fecha_arribo','estado',
        'total_cif','total_impuestos','total_aduanales','notas'
    ];
    protected $casts = ['fecha_arribo' => 'date'];
 
    // Relaciones
    public function usuario() { return $this->belongsTo(Usuario::class, 'id_usuario'); }
    public function empresaImportadora() { return $this->belongsTo(EmpresaImportadora::class, 'id_empresa_mx'); }
    public function empresaExtranjera() { return $this->belongsTo(EmpresaExtranjera::class, 'id_empresa_extranjera'); }
    public function items() { return $this->hasMany(ItemImportacion::class, 'id_importacion'); }
    public function documentos() { return $this->hasMany(Documento::class, 'id_importacion'); }
    public function impuestos() { return $this->hasMany(Impuesto::class, 'id_importacion'); }
    public function costos() { return $this->hasMany(CostoImportacion::class, 'id_importacion'); }
    public function pagos() { return $this->hasMany(Pago::class, 'id_importacion'); }
    public function agentes() {
        return $this->belongsToMany(AgenteAduanal::class, 'importacion_agente', 'id_importacion', 'id_agente')
                    ->withPivot('asignado_en');
    }
    public function logsSistemas() { return $this->hasMany(LogSistemaExterno::class, 'id_importacion'); }
 
    // Accessor para estado en español
    public function getEstadoLabelAttribute(): string {
        return match($this->estado) {
            'borrador'   => 'Borrador',
            'en_tramite' => 'En Trámite',
            'en_aduana'  => 'En Aduana',
            'liberada'   => 'Liberada',
            'entregada'  => 'Entregada',
            'cancelada'  => 'Cancelada',
            default      => $this->estado,
        };
    }
    // Colores Bootstrap por estado
    public function getEstadoColorAttribute(): string {
        return match($this->estado) {
            'borrador'   => 'secondary',
            'en_tramite' => 'info',
            'en_aduana'  => 'warning',
            'liberada'   => 'primary',
            'entregada'  => 'success',
            'cancelada'  => 'danger',
            default      => 'light',
        };
    }
}
