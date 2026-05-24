<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->id('id_ubicacion');
            $table->string('ciudad', 50)->nullable();
            $table->string('localidad', 50)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->boolean('es_sede')->default(false);
            $table->string('nombre_sede', 50)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ubicacion');
    }
};
