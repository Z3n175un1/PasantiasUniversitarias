<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilEmpresa extends Model
{
    use HasFactory;
    protected $table = 'perfiles_empresa';
    public $timestamps = false;
    protected $guarded = [];
}
