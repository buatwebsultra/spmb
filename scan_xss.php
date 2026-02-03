<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$patterns = [
    '<script',
    'javascript:',
    'onerror',
    'onload',
    'onclick',
    '<iframe>',
    'eval(',
    'document.cookie'
];

// Get all table names using Schema facade (works with SQLite and MySQL)
$tables = Schema::getAllTables();
$tableNames = array_map(function($table) {
    // Extract table name from object (format varies by driver)
    $tableArray = (array) $table;
    return reset($tableArray);
}, $tables);

$findings = [];

foreach ($tableNames as $table) {
    $columns = Schema::getColumnListing($table);
    
    foreach ($columns as $column) {
        foreach ($patterns as $pattern) {
            $results = DB::table($table)
                ->where($column, 'LIKE', "%$pattern%")
                ->get();
            
            if ($results->count() > 0) {
                foreach ($results as $row) {
                    $findings[] = [
                        'table' => $table,
                        'column' => $column,
                        'pattern' => $pattern,
                        'id' => $row->id ?? 'N/A',
                        'value' => substr((string)$row->$column, 0, 100)
                    ];
                }
            }
        }
    }
}

if (empty($findings)) {
    echo "No XSS payloads found in the database.\n";
} else {
    echo "Potential XSS payloads found:\n";
    print_r($findings);
}
