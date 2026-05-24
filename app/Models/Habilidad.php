<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    use HasFactory;
    protected $table = 'habilidad';
    protected $primaryKey = 'id_habilidad';
    public $timestamps = false;
    protected $guarded = [];
}
