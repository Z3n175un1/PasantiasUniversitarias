<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoEstudiante extends Model
{
    use HasFactory;
    protected $table = 'documentos_estudiante';
    public $timestamps = false;
    protected $guarded = [];
}
