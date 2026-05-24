<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accion', function (Blueprint $table) {
            $table->id('id_accion');
            $table->foreignId('id_usuario')->nullable()->constrained('usuario', 'id_usuario')->onDelete('set null');
            $table->string('tipo_accion', 50)->nullable();
            $table->text('descripcion');
            $table->timestamp('fecha_accion');
            $table->string('direccion_ip', 45)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('accion');
    }
};
