<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=db_spmb", "root", "");
    $stmt = $pdo->query("SELECT id, nisn, nama_depan, photo, ijazah, transkip FROM d_pendaftaran WHERE (photo IS NOT NULL AND photo != '') OR (ijazah IS NOT NULL AND ijazah != '') LIMIT 5");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($data)) {
        echo "No data found with photo or ijazah.\n";
    } else {
        foreach ($data as $row) {
            echo "ID: {$row['id']} | Name: {$row['nama_depan']}\n";
            echo "  Photo: |{$row['photo']}|\n";
            echo "  Ijazah: |{$row['ijazah']}|\n";
            echo "  Transkip: |{$row['transkip']}|\n";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
