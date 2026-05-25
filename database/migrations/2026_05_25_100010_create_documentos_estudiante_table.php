<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_estudiante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_estudiante_id')->constrained('perfiles_estudiante')->cascadeOnDelete();
            $table->foreignId('tipo_documento_id')->constrained('tipos_documento')->cascadeOnDelete();
            $table->string('nombre_original', 255);
            $table->string('ruta_almacenamiento', 255);
            $table->string('tipo_mime', 100);
            $table->integer('tamano_bytes');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('documentos_estudiante');
    }
};
