<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_postulacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postulacion_id')->constrained('postulaciones')->cascadeOnDelete();
            $table->foreignId('documento_estudiante_id')->constrained('documentos_estudiante')->cascadeOnDelete();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('documentos_postulacion');
    }
};
