<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reporte', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->date('fecha_reporte');
            $table->integer('total_estudiantes')->default(0);
            $table->integer('total_empresas')->default(0);
            $table->integer('nuevas_postulaciones')->default(0);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};
