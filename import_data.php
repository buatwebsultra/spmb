<?php
set_time_limit(0);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'db_spmb';
$file = 'd:/PROJECT/spmb/db_spmb2024.sql';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 300
    ]);
    
    echo "Creating database if not exists...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$db`");
    
    echo "Starting import from $file...\n";
    
    $handle = fopen($file, "r");
    if (!$handle) {
        throw new Exception("Could not open file: $file");
    }
    
    $query = '';
    $count = 0;
    $executed = 0;
    while (($line = fgets($handle)) !== false) {
        $count++;
        if ($count % 10000 == 0) {
            echo "Processed $count lines, executed $executed queries...\n";
        }

        $trimmed = trim($line);
        if ($trimmed == '' || str_starts_with($trimmed, '--') || str_starts_with($trimmed, '/*') || str_starts_with($trimmed, '#')) {
            continue;
        }
        
        $query .= $line;
        
        if (str_ends_with($trimmed, ';')) {
            try {
                $pdo->exec($query);
                $executed++;
            } catch (Exception $e) {
                echo "Error at line $count: " . $e->getMessage() . "\n";
            }
            $query = '';
        }
    }
    fclose($handle);
    
    echo "Import completed! Total lines: $count, Total queries: $executed\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
