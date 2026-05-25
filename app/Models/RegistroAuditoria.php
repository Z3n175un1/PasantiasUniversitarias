<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroAuditoria extends Model
{
    use HasFactory;
    protected $table = 'registro_auditoria';
    public $timestamps = false;
    protected $guarded = [];
}
