<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitoHabilidadOferta extends Model
{
    use HasFactory;

    protected $table = 'requisitos_habilidad_oferta';
    public $timestamps = false;
    protected $guarded = [];

    // Relación con OfertaPasantia
    public function ofertaPasantia()
    {
        return $this->belongsTo(OfertaPasantia::class, 'oferta_pasantia_id');
    }

    // Relación con Habilidad
    public function habilidad()
    {
        return $this->belongsTo(Habilidad::class, 'habilidad_id');
    }
}