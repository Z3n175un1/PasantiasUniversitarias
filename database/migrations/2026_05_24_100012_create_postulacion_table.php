<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postulacion', function (Blueprint $table) {
            $table->id('id_postulacion');
            $table->foreignId('id_estudiante')->nullable()->constrained('estudiante', 'id_estudiante')->onDelete('cascade');
            $table->foreignId('id_pasantia')->nullable()->constrained('pasantia', 'id_pasantia')->onDelete('cascade');
            $table->date('fecha_postulacion');
            $table->string('estado', 20)->default('Pendiente');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('postulacion');
    }
};
