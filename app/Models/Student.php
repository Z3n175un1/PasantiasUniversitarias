<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $table = 'estudiantes';

    protected $fillable = [
        'usuario_id',
        'apellidos',
        'fecha_nacimiento',
        'ci',
        'carrera_id',
        'tiene_pasantia',
        'cv',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class, 'carrera_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'estudiante_id');
    }
}

