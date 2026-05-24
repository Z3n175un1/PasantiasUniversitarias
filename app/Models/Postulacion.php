<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;
    protected $table = 'postulacion';
    protected $primaryKey = 'id_postulacion';
    public $timestamps = false;
    protected $guarded = [];
}
