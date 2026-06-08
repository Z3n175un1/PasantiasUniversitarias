<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfiles_estudiante', function (Blueprint $table) {
            $table->integer('semestre_actual')->nullable()->after('carrera');
        });
    }

    public function down(): void
    {
        Schema::table('perfiles_estudiante', function (Blueprint $table) {
            $table->dropColumn('semestre_actual');
        });
    }
};
