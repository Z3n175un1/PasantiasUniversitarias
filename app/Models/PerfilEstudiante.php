<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilEstudiante extends Model
{
    protected $table = 'perfiles_estudiante';

    protected $fillable = [
        'usuario_id',
        'universidad',
        'carrera',
        'anio_graduacion',
        'biografia',
    ];

    public $timestamps = false;

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación con Habilidades
    public function habilidades()
    {
        return $this->hasMany(HabilidadEstudiante::class, 'perfil_estudiante_id');
    }

    // Relación con Documentos
    public function documentos()
    {
        return $this->hasMany(DocumentoEstudiante::class, 'perfil_estudiante_id');
    }
}