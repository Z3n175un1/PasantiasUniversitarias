<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ofertas_pasantia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_empresa_id')->constrained('perfiles_empresa')->cascadeOnDelete();
            $table->foreignId('ubicacion_id')->constrained('ubicaciones')->cascadeOnDelete();
            $table->foreignId('estado_publicacion_id')->constrained('estados_publicacion')->cascadeOnDelete();
            $table->string('titulo', 200);
            $table->text('descripcion');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ofertas_pasantia');
    }
};
