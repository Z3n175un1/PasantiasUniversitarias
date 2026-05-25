<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaPasantia extends Model
{
    use HasFactory;

    protected $table = 'ofertas_pasantia';
    public $timestamps = false;
    protected $guarded = [];

    // Relación con PerfilEmpresa
    public function perfilEmpresa()
    {
        return $this->belongsTo(PerfilEmpresa::class, 'perfil_empresa_id');
    }

    // Relación con Ubicacion
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    // Relación con EstadoPublicacion
    public function estadoPublicacion()
    {
        return $this->belongsTo(EstadoPublicacion::class, 'estado_publicacion_id');
    }

    // Relación con RequisitosHabilidadOferta
    public function requisitosHabilidad()
    {
        return $this->hasMany(RequisitoHabilidadOferta::class, 'oferta_pasantia_id');
    }

    // Relación con Postulaciones
    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'oferta_pasantia_id');
    }
}