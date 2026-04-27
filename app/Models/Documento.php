<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';
    protected $primaryKey = 'id_documento';
    protected $fillable = [
        'id_importacion', 'id_usuario_sube', 'id_usuario_valida',
        'tipo_documento', 'ruta_archivo', 'validado', 'fecha_validacion'
    ];
    protected $casts = ['validado' => 'boolean', 'fecha_validacion' => 'datetime'];
 
    public function importacion()  { return $this->belongsTo(Importacion::class,  'id_importacion'); }
    public function usuarioSube()  { return $this->belongsTo(Usuario::class, 'id_usuario_sube',  'id_usuario'); }
    public function usuarioValida(){ return $this->belongsTo(Usuario::class, 'id_usuario_valida','id_usuario'); }
}