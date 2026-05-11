<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaImportadora extends Model
{
    protected $table = 'empresa_importadora';
    protected $primaryKey = 'id_empresa_mx';

    public $timestamps = false;

    protected $fillable = [
        'RFC_empresa', 'razon_social',
        'padron_importadores', 'giro_comercial'
    ];

    public function importaciones()
    {
        return $this->hasMany(Importacion::class, 'id_empresa_mx', 'id_empresa_mx');
    }
}
