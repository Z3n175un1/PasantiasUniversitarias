<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasantia extends Model
{
    use HasFactory;
    protected $table = 'pasantia';
    protected $primaryKey = 'id_pasantia';
    public $timestamps = false;
    protected $guarded = [];
}
