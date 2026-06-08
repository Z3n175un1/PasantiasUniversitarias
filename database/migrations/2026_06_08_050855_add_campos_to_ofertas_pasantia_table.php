<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ofertas_pasantia', function (Blueprint $table) {
            $table->text('requisitos')->nullable()->after('carrera');
            $table->text('beneficios')->nullable()->after('requisitos');
            $table->unsignedTinyInteger('vacantes_disponibles')->default(1)->after('beneficios');
            $table->unsignedSmallInteger('duracion_semanas')->nullable()->after('vacantes_disponibles');
        });
    }

    public function down(): void
    {
        Schema::table('ofertas_pasantia', function (Blueprint $table) {
            $table->dropColumn(['requisitos', 'beneficios', 'vacantes_disponibles', 'duracion_semanas']);
        });
    }
};
