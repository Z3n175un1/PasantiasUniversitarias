<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    use HasFactory;

    protected $table = 'habilidades';
    public $timestamps = false;
    protected $guarded = [];

    // Relación con RequisitosHabilidadOferta
    public function requisitosHabilidad()
    {
        return $this->hasMany(RequisitoHabilidadOferta::class, 'habilidad_id');
    }
}