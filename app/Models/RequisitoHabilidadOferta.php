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
}
