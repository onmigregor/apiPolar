<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "--- TABLA: customers ---\n";
$columns = DB::select('DESCRIBE customers');
foreach ($columns as $column) {
    echo "- " . $column->Field . "\n";
}
