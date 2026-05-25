<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habilidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('categoria', 100);
            $table->text('descripcion')->nullable();
            $table->tinyInteger('activa')->default(1);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('habilidades');
    }
};
