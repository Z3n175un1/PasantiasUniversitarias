<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('fix:sequences', function () {
    $tables = DB::select("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public' ORDER BY tablename");
    $count = 0;
    foreach ($tables as $table) {
        $seqName = $table->tablename . '_id_seq';
        $seqExists = DB::select("SELECT 1 FROM pg_catalog.pg_sequences WHERE schemaname = 'public' AND sequencename = ?", [$seqName]);
        if (!empty($seqExists)) {
            DB::statement("SELECT setval('{$seqName}', COALESCE((SELECT MAX(id) FROM {$table->tablename}), 0) + 1, false)");
            $this->info("✓ {$seqName} reseteada");
            $count++;
        }
    }
    $this->info("{$count} secuencias reseteadas correctamente.");
})->purpose('Resetea todas las secuencias de PostgreSQL al MAX(id)+1');
