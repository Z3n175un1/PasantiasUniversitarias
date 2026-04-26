<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'usuario_id',
        'nombre',
        'industria',
        'ubicacion',
    ];
}
