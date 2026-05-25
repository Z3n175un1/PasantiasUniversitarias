<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    // DESACTIVAR TIMESTAMPS
    public $timestamps = false;

    protected $fillable = [
        'rol_id',
        'nombre',
        'correo',
        'contrasena_hash',
        'activo',
        'creado_en', // Tu tabla usa 'creado_en', no 'created_at'
    ];

    protected $hidden = [
        'contrasena_hash',
        'remember_token',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Para que Auth funcione con tu BD
    public function getAuthPassword()
    {
        return $this->contrasena_hash;
    }

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function perfilEstudiante()
    {
        return $this->hasOne(PerfilEstudiante::class, 'usuario_id');
    }

    public function perfilEmpresa()
    {
        return $this->hasOne(PerfilEmpresa::class, 'usuario_id');
    }

    public function esEstudiante()
    {
        return $this->rol_id == 1;
    }

    public function esEmpresa()
    {
        return $this->rol_id == 2;
    }

    public function esAdministrador()
    {
        return $this->rol_id == 3;
    }
}