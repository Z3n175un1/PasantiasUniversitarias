<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('ciudad', 100);
            $table->string('region', 100)->nullable();
            $table->string('pais', 100);
            $table->string('codigo_pais', 2);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
