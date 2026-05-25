<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfiles_empresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->unique()->constrained('usuarios')->cascadeOnDelete();
            $table->string('nombre_empresa', 200);
            $table->string('industria', 100);
            $table->string('sitio_web', 255)->nullable();
            $table->tinyInteger('verificada')->default(0);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('perfiles_empresa');
    }
};
