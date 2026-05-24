<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id('id_estudiante');
            $table->foreignId('id_usuario')->nullable()->constrained('usuario', 'id_usuario')->onDelete('cascade');
            $table->foreignId('id_carrera')->nullable()->constrained('carrera', 'id_carrera')->onDelete('restrict');
            $table->string('ci', 12)->unique();
            $table->string('email_institucional', 100)->nullable()->unique();
            $table->date('fecha_nacimiento');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('estudiante');
    }
};
