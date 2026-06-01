<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registro_auditoria', function (Blueprint $table) {
            $table->json('valor_anterior')->nullable()->after('accion');
            $table->json('valor_nuevo')->nullable()->after('valor_anterior');
        });
    }

    public function down(): void
    {
        Schema::table('registro_auditoria', function (Blueprint $table) {
            $table->dropColumn(['valor_anterior', 'valor_nuevo']);
        });
    }
};
