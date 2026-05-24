<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rubro', function (Blueprint $table) {
            $table->id('id_rubro');
            $table->string('nombre_rubro', 50);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('rubro');
    }
};
