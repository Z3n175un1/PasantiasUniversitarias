<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id('id_ticket');
            $table->foreignId('id_usuario')->nullable()->constrained('usuario', 'id_usuario')->onDelete('cascade');
            $table->string('titulo', 100);
            $table->text('descripcion');
            $table->string('tipo_ticket', 30)->nullable();
            $table->integer('prioridad');
            $table->boolean('revisado')->default(false);
            $table->date('fecha_creacion');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
