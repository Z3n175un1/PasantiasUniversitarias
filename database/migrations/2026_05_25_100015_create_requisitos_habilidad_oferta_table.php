<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requisitos_habilidad_oferta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oferta_pasantia_id')->constrained('ofertas_pasantia')->cascadeOnDelete();
            $table->foreignId('habilidad_id')->constrained('habilidades')->cascadeOnDelete();
            $table->decimal('peso', 5,2)->nullable();
            $table->integer('nivel_minimo')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('requisitos_habilidad_oferta');
    }
};
