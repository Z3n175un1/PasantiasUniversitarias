<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'estudiantes';

    protected $fillable = [
        'usuario_id',
        'apellidos',
        'fecha_nacimiento',
        'carrera_id',
        'tiene_pasantia',
    ];
}
