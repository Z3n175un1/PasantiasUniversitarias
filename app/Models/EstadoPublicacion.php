<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPublicacion extends Model
{
    use HasFactory;

    protected $table = 'estados_publicacion';
    public $timestamps = false;
    protected $guarded = [];

    public function ofertas()
    {
        return $this->hasMany(OfertaPasantia::class, 'estado_publicacion_id');
    }
}