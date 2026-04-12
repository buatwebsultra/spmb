<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$set = Illuminate\Support\Facades\DB::table('d_setting')->first();
echo "Logo App: " . $set->logo_app . "\n";
echo "Instansi: " . $set->instansi . "\n";
