<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_puntaje_topsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postulacion_id')->constrained('postulaciones')->cascadeOnDelete();
            $table->foreignId('habilidad_id')->constrained('habilidades')->cascadeOnDelete();
            $table->decimal('valor_bruto', 7,2)->nullable();
            $table->decimal('valor_normalizado', 10,4)->nullable();
            $table->decimal('valor_ponderado', 10,4)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('detalle_puntaje_topsis');
    }
};
