<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('algoritmos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained('estudiantes');
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->decimal('puntaje', 5, 2)->nullable();
            $table->text('foda')->nullable();
            $table->text('evaluacion')->nullable();
            $table->date('fecha_aplicacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('algoritmos');
    }
};
