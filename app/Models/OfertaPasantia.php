<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaPasantia extends Model
{
    use HasFactory;
    protected $table = 'ofertas_pasantia';
    public $timestamps = false;
    protected $guarded = [];
}
