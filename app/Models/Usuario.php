<?php

namespace App\Models;

use App\Notifications\ResetPassword;
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
        'ap_paterno',
        'ap_materno',
        'correo',
        'contrasena_hash',
        'activo',
        'creado_en',
    ];

    protected $hidden = [
        'contrasena_hash',
        'remember_token',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'creado_en' => 'datetime',
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

    public function getNameAttribute()
    {
        return $this->nombre;
    }

    public function getEmailAttribute()
    {
        return $this->correo;
    }

    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    public function routeNotificationForMail()
    {
        return $this->correo;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}