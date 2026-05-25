<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_estudiante_id')->constrained('perfiles_estudiante')->cascadeOnDelete();
            $table->foreignId('oferta_pasantia_id')->constrained('ofertas_pasantia')->cascadeOnDelete();
            $table->foreignId('estado_postulacion_id')->constrained('estados_postulacion')->cascadeOnDelete();
            $table->decimal('puntaje_topsis', 5,2)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};
