<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;
    protected $table = 'postulaciones';
    public $timestamps = false;
    protected $guarded = [];

    public function perfilEstudiante()
    {
        return $this->belongsTo(PerfilEstudiante::class, 'perfil_estudiante_id');
    }

    public function ofertaPasantia()
    {
        return $this->belongsTo(OfertaPasantia::class, 'oferta_pasantia_id');
    }

    public function estadoPostulacion()
    {
        return $this->belongsTo(EstadoPostulacion::class, 'estado_postulacion_id');
    }
}
