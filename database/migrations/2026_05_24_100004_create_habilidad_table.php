<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habilidad', function (Blueprint $table) {
            $table->id('id_habilidad');
            $table->string('nombre_habilidad', 50);
            $table->string('tipo_habilidad', 30)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('habilidad');
    }
};
