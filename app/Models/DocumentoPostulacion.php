<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoPostulacion extends Model
{
    use HasFactory;
    protected $table = 'documentos_postulacion';
    public $timestamps = false;
    protected $guarded = [];
}
