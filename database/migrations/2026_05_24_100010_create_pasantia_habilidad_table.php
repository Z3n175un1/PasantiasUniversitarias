<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasantia_habilidad', function (Blueprint $table) {
            $table->foreignId('id_pasantia')->nullable()->constrained('pasantia', 'id_pasantia')->onDelete('cascade');
            $table->foreignId('id_habilidad')->nullable()->constrained('habilidad', 'id_habilidad')->onDelete('cascade');
            $table->primary(['id_pasantia', 'id_habilidad']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pasantia_habilidad');
    }
};
