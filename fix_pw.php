<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
DB::table('usuarios')->update(['contrasena_hash' => bcrypt('password')]);
echo "SUCCESS";
