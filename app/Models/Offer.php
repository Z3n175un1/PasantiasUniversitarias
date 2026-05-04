<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{  
    protected table $ofertas;
    protected $fillable = [
        'titulo',
        'tipo',
        'duracion',
        'carrera'
    ];
    public function ofertas():belongsTo{
        return $this->belongsTo(offers::class, 'ofertas_id');
    }
}