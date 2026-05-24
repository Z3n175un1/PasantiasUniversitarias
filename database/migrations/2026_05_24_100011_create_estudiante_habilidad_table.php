<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante_habilidad', function (Blueprint $table) {
            $table->foreignId('id_estudiante')->nullable()->constrained('estudiante', 'id_estudiante')->onDelete('cascade');
            $table->foreignId('id_habilidad')->nullable()->constrained('habilidad', 'id_habilidad')->onDelete('cascade');
            $table->primary(['id_estudiante', 'id_habilidad']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('estudiante_habilidad');
    }
};
