<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'rol_id',
        'nombre',
        'correo',
        'contrasena_hash',
        'activo',
    ];

    protected $hidden = [
        'contrasena_hash',
        'remember_token',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'creado_en' => 'datetime',
    ];

    // Esto es lo que faltaba - decirle a Laravel que use 'correo' como email
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    // Para que Auth::attempt() funcione con 'correo'
    public function getAuthPassword()
    {
        return $this->contrasena_hash;
    }

    // Relación con Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación con PerfilEstudiante
    public function perfilEstudiante()
    {
        return $this->hasOne(PerfilEstudiante::class, 'usuario_id');
    }

    // Relación con PerfilEmpresa
    public function perfilEmpresa()
    {
        return $this->hasOne(PerfilEmpresa::class, 'usuario_id');
    }

    // Métodos helper para roles
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