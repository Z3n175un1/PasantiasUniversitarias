<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasantia', function (Blueprint $table) {
            $table->id('id_pasantia');
            $table->foreignId('id_empresa')->nullable()->constrained('empresa', 'id_empresa')->onDelete('cascade');
            $table->foreignId('id_ubicacion')->nullable()->constrained('ubicacion', 'id_ubicacion')->onDelete('restrict');
            $table->string('titulo', 100);
            $table->text('descripcion');
            $table->string('area', 50)->nullable();
            $table->date('fecha_publicacion');
            $table->date('fecha_cierre');
            $table->boolean('activa')->default(true);
        });
        \DB::unprepared('CREATE OR REPLACE FUNCTION validar_fechas_pasantia() RETURNS TRIGGER AS $$ BEGIN IF NEW.fecha_cierre < NEW.fecha_publicacion THEN RAISE EXCEPTION \'La fecha de cierre no puede ser anterior a la fecha de publicación\'; END IF; RETURN NEW; END; $$ LANGUAGE plpgsql;');
        \DB::unprepared('CREATE TRIGGER trg_validar_fechas_pasantia BEFORE INSERT OR UPDATE ON pasantia FOR EACH ROW EXECUTE FUNCTION validar_fechas_pasantia();');
    }
    public function down(): void
    {
        Schema::dropIfExists('pasantia');
    }
};
