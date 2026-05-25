<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones';
    public $timestamps = false;
    protected $guarded = [];

    public function ofertas()
    {
        return $this->hasMany(OfertaPasantia::class, 'ubicacion_id');
    }
}