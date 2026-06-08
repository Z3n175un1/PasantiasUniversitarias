<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilEmpresa extends Model
{
    protected $table = 'perfiles_empresa';

    protected $fillable = [
        'usuario_id',
        'nombre_empresa',
        'industria',
        'descripcion',
        'telefono',
        'direccion',
        'tamano_empresa',
        'anio_fundacion',
        'sitio_web',
        'verificada',
    ];

    protected $casts = [
        'verificada' => 'boolean',
    ];

    public $timestamps = false;

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación con Ofertas
    public function ofertas()
    {
        return $this->hasMany(OfertaPasantia::class, 'perfil_empresa_id');
    }
}