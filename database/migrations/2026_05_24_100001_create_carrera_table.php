<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrera', function (Blueprint $table) {
            $table->id('id_carrera');
            $table->string('nombre_carrera', 100);
            $table->string('area', 50)->nullable();
            $table->string('tipo_carrera', 30)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('carrera');
    }
};
