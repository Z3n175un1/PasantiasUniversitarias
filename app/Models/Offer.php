<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'ofertas';

    protected $fillable = [
        'empresa_id',
        'titulo',
        'tipo',
        'carrera_id',
        'fecha_inicio',
        'fecha_fin',
        'requisitos',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'empresa_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'carrera_id');
    }
}