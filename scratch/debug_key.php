<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$key = config('app.key');
$cipher = config('app.cipher');

echo "Cipher: " . $cipher . "\n";
echo "Key Length: " . strlen($key) . "\n";
if (str_starts_with($key, 'base64:')) {
    $decoded = base64_decode(substr($key, 7));
    echo "Decoded Key Length: " . strlen($decoded) . " bytes\n";
} else {
    echo "Key is not base64 encoded\n";
}
