<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->foreignId('id_rol')->nullable()->constrained('rol', 'id_rol')->onDelete('restrict');
            $table->string('email', 100)->unique();
            $table->string('contrasena_hash', 255);
            $table->boolean('activo')->default(true);
            $table->integer('intentos_fallidos')->default(0);
            $table->boolean('eula_aceptada')->default(false);
            $table->date('fecha_creacion');
        });
        \DB::unprepared('CREATE OR REPLACE FUNCTION bloquear_usuario_intentos() RETURNS TRIGGER AS $$ BEGIN IF NEW.intentos_fallidos >= 3 THEN NEW.activo := FALSE; END IF; RETURN NEW; END; $$ LANGUAGE plpgsql;');
        \DB::unprepared('CREATE TRIGGER trg_bloquear_usuario_intentos BEFORE UPDATE ON usuario FOR EACH ROW WHEN (NEW.intentos_fallidos IS DISTINCT FROM OLD.intentos_fallidos) EXECUTE FUNCTION bloquear_usuario_intentos();');
    }
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
