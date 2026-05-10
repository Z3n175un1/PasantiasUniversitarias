<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'postulaciones';

    protected $fillable = [
        'estudiante_id',
        'oferta_id',
        'fecha_postulacion',
        'estado',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'estudiante_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'oferta_id');
    }
}

