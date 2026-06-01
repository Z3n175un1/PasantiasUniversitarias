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

    protected $casts = [
        'valor_anterior' => 'array',
        'valor_nuevo' => 'array',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function tipoEntidad()
    {
        return $this->belongsTo(TipoEntidad::class, 'tipo_entidad_id');
    }

    public function cambiosFormateados(): array
    {
        $anterior = $this->valor_anterior ?? [];
        $nuevo = $this->valor_nuevo ?? [];
        $cambios = [];

        $etiquetas = [
            'nombre' => 'Nombre',
            'ap_paterno' => 'Ap. Paterno',
            'ap_materno' => 'Ap. Materno',
            'correo' => 'Correo',
            'rol_id' => 'Rol',
            'activo' => 'Estado',
            'contrasena_hash' => 'Contraseña',
            'titulo' => 'Título',
            'descripcion' => 'Descripción',
            'ubicacion_id' => 'Ubicación',
            'fecha_inicio' => 'Fecha inicio',
            'fecha_fin' => 'Fecha fin',
            'estado_publicacion_id' => 'Estado publicación',
            'nombre_empresa' => 'Nombre empresa',
            'industria' => 'Industria',
            'sitio_web' => 'Sitio web',
            'verificada' => 'Verificada',
            'universidad' => 'Universidad',
            'carrera' => 'Carrera',
            'anio_graduacion' => 'Año graduación',
        ];

        $roles = [1 => 'Estudiante', 2 => 'Empresa', 3 => 'Admin'];

        foreach ($nuevo as $campo => $valorNuevo) {
            $valorAnterior = $anterior[$campo] ?? null;

            if ($valorAnterior == $valorNuevo) continue;

            $label = $etiquetas[$campo] ?? $campo;
            $antes = $valorAnterior;
            $despues = $valorNuevo;

            if ($campo === 'rol_id') {
                $antes = $roles[$valorAnterior] ?? $valorAnterior;
                $despues = $roles[$valorNuevo] ?? $valorNuevo;
            }
            if ($campo === 'activo' || $campo === 'verificada') {
                $antes = $valorAnterior ? 'Sí' : 'No';
                $despues = $valorNuevo ? 'Sí' : 'No';
            }
            if ($campo === 'contrasena_hash') {
                $despues = '••••••••';
                $antes = $valorAnterior ? '••••••••' : '(vacía)';
            }

            $cambios[] = [
                'campo' => $label,
                'antes' => $antes ?? '(vacío)',
                'despues' => $despues ?? '(vacío)',
            ];
        }

        return $cambios;
    }
}
