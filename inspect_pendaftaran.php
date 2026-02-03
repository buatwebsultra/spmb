<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=db_spmb", "root", "");
    $stmt = $pdo->query("SELECT id, nisn, nama, photo, ijazah, transkip FROM d_pendaftaran LIMIT 10 OFFSET 100");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Sample Registration Data (Page 2 area):\n";
    foreach ($data as $row) {
        echo "ID: {$row['id']} | Name: {$row['nama']}\n";
        echo "  Photo: " . ($row['photo'] ?: 'N/A') . "\n";
        echo "  Ijazah: " . ($row['ijazah'] ?: 'N/A') . "\n";
        echo "  Transkip: " . ($row['transkip'] ?: 'N/A') . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
