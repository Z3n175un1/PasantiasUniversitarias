<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroAuditoria extends Model
{
    use HasFactory;
    protected $table = 'registro_auditoria';
    public $timestamps = false;
    protected $guarded = [];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function tipoEntidad()
    {
        return $this->belongsTo(TipoEntidad::class, 'tipo_entidad_id');
    }
}
