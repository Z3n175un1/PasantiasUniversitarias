<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePuntajeTopsis extends Model
{
    use HasFactory;
    protected $table = 'detalle_puntaje_topsis';
    public $timestamps = false;
    protected $guarded = [];

    public function postulacion()
    {
        return $this->belongsTo(Postulacion::class, 'postulacion_id');
    }

    public function habilidad()
    {
        return $this->belongsTo(Habilidad::class, 'habilidad_id');
    }
}
