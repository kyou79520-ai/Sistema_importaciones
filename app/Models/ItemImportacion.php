<?php




class ItemImportacion extends Model {
    protected $table = 'item_importacion';
    protected $primaryKey = 'id_item';
    protected $fillable = [
        'id_importacion','numero_linea','descripcion',
        'cantidad','unidad_medida','valor_unitario','peso_kg','codigo_hs'
    ];
    protected $casts = ['cantidad' => 'float', 'valor_unitario' => 'float'];
 
    public function importacion() { return $this->belongsTo(Importacion::class, 'id_importacion'); }
 
    public function getValorTotalAttribute(): float {
        return $this->cantidad * $this->valor_unitario;
    }
}