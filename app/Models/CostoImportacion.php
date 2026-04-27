<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class CostoImportacion extends Model
{
    protected $table = 'costo_importacion';
    protected $primaryKey = 'id_costo';
    protected $fillable = [
        'id_importacion','tipo_costo','seguro',
        'gastos_aduanales','otros_gastos','total_costos','moneda'
    ];
 
    public function importacion() { return $this->belongsTo(Importacion::class, 'id_importacion'); }
}