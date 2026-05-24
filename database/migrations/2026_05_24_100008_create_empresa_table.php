<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id('id_empresa');
            $table->foreignId('id_usuario')->nullable()->constrained('usuario', 'id_usuario')->onDelete('cascade');
            $table->string('nombre_empresa', 100);
            $table->foreignId('id_rubro')->nullable()->constrained('rubro', 'id_rubro')->onDelete('restrict');
            $table->foreignId('id_ubicacion')->nullable()->constrained('ubicacion', 'id_ubicacion')->onDelete('restrict');
            $table->text('descripcion');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('empresa');
    }
};
