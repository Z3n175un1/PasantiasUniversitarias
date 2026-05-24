<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documento', function (Blueprint $table) {
            $table->id('id_documento');
            $table->foreignId('id_estudiante')->nullable()->constrained('estudiante', 'id_estudiante')->onDelete('cascade');
            $table->string('tipo_documento', 30)->nullable();
            $table->string('archivo_nombre', 255);
            $table->string('archivo_hash', 255);
            $table->string('extension', 10)->nullable();
            $table->date('fecha_subida');
            $table->boolean('encriptado')->default(false);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('documento');
    }
};
