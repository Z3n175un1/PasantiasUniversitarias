<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('ap_paterno', 100)->nullable()->after('nombre');
            $table->string('ap_materno', 100)->nullable()->after('ap_paterno');
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn(['ap_paterno', 'ap_materno']);
        });
    }
};
