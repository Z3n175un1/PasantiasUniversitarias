<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfiles_empresa', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->after('industria');
            $table->string('telefono', 30)->nullable()->after('descripcion');
            $table->string('direccion', 255)->nullable()->after('telefono');
            $table->string('tamano_empresa', 30)->nullable()->after('direccion');
            $table->year('anio_fundacion')->nullable()->after('tamano_empresa');
        });
    }

    public function down(): void
    {
        Schema::table('perfiles_empresa', function (Blueprint $table) {
            $table->dropColumn(['descripcion', 'telefono', 'direccion', 'tamano_empresa', 'anio_fundacion']);
        });
    }
};
