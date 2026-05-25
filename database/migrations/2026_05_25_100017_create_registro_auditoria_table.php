<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registro_auditoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
            $table->foreignId('tipo_entidad_id')->constrained('tipos_entidad')->cascadeOnDelete();
            $table->unsignedBigInteger('entidad_id');
            $table->string('accion', 100);
            $table->timestamp('creado_en')->useCurrent();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('registro_auditoria');
    }
};
