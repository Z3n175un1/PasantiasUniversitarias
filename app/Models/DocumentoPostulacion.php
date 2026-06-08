<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoPostulacion extends Model
{
    use HasFactory;
    protected $table = 'documentos_postulacion';
    public $timestamps = false;
    protected $guarded = [];

    public function postulacion()
    {
        return $this->belongsTo(Postulacion::class, 'postulacion_id');
    }

    public function documentoEstudiante()
    {
        return $this->belongsTo(DocumentoEstudiante::class, 'documento_estudiante_id');
    }
}
