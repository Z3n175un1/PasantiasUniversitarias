<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;
    protected $table = 'usuarios';
    public $timestamps = false;
    protected $guarded = [];

    // Custom auth names mapping
    public function getAuthPassword()
    {
        return $this->contrasena_hash;
    }

    public function perfilEmpresa() { return $this->belongsTo(PerfilEmpresa::class, 'perfil_empresa_id'); }
    public function ubicacion() { return $this->belongsTo(Ubicacion::class, 'ubicacion_id'); }
    public function ofertasPasantias() { return $this->hasMany(OfertaPasantia::class, 'perfil_empresa_id'); }
    public function postulaciones() { return $this->hasMany(Postulacion::class, 'perfil_estudiante_id'); }
    public function ofertaPasantia() { return $this->belongsTo(OfertaPasantia::class, 'oferta_pasantia_id'); }

}
