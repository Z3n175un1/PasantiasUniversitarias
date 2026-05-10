<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'carreras';

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'facultad_id');
    }
}


