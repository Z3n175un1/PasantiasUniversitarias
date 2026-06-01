<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabilidadEstudiante extends Model
{
    use HasFactory;
    protected $table = 'habilidades_estudiante';
    public $timestamps = false;
    protected $guarded = [];

    public function perfilEstudiante()
    {
        return $this->belongsTo(PerfilEstudiante::class, 'perfil_estudiante_id');
    }

    public function habilidad()
    {
        return $this->belongsTo(Habilidad::class, 'habilidad_id');
    }
}
