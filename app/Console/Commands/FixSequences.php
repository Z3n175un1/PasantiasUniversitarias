<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixSequences extends Command
{
    protected $signature = 'fix:sequences';
    protected $description = 'Resetea todas las secuencias de PostgreSQL al MAX(id)+1';

    public function handle()
    {
        $tables = DB::select("
            SELECT tablename FROM pg_catalog.pg_tables
            WHERE schemaname = 'public'
            ORDER BY tablename
        ");

        $count = 0;
        foreach ($tables as $table) {
            $tableName = $table->tablename;
            $seqName = "{$tableName}_id_seq";

            $seqExists = DB::select(
                "SELECT 1 FROM pg_catalog.pg_sequences WHERE schemaname = 'public' AND sequencename = ?",
                [$seqName]
            );

            if (!empty($seqExists)) {
                DB::statement("SELECT setval('{$seqName}', COALESCE((SELECT MAX(id) FROM {$tableName}), 0) + 1, false)");
                $this->info("✓ {$seqName} reseteada");
                $count++;
            }
        }

        $this->info("{$count} secuencias reseteadas correctamente.");
    }
}
