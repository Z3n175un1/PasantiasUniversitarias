<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('requisitos_habilidad_oferta', function (Blueprint $table) {
            $table->enum('tipo_criterio', ['benefit', 'cost'])->default('benefit')->after('nivel_minimo');
        });
    }

    public function down(): void
    {
        Schema::table('requisitos_habilidad_oferta', function (Blueprint $table) {
            $table->dropColumn('tipo_criterio');
        });
    }
};
