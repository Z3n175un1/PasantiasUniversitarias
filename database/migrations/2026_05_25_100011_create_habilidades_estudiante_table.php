<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habilidades_estudiante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_estudiante_id')->constrained('perfiles_estudiante')->cascadeOnDelete();
            $table->foreignId('habilidad_id')->constrained('habilidades')->cascadeOnDelete();
            $table->integer('nivel');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('habilidades_estudiante');
    }
};
