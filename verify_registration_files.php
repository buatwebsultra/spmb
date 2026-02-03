<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=db_spmb", "root", "");
    $stmt = $pdo->query("SELECT id, nisn, nama_depan, photo_image, ijazah_image, transkip_image FROM d_pendaftaran WHERE photo_image IS NOT NULL OR ijazah_image IS NOT NULL LIMIT 20 OFFSET 100");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Verification of Registration Assets (Page 2 area):\n";
    foreach ($data as $row) {
        echo "ID: {$row['id']} | Name: {$row['nama_depan']}\n";
        
        $files = [
            'photo' => $row['photo_image'],
            'ijazah' => $row['ijazah_image'],
            'transkip' => $row['transkip_image']
        ];
        
        foreach ($files as $folder => $filename) {
            if (!$filename) {
                echo "  $folder: N/A\n";
                continue;
            }
            $path = "public/$folder/$filename";
            if (file_exists($path)) {
                echo "  $folder: OK ($filename)\n";
            } else {
                echo "  $folder: MISSING ($filename) - Checked: $path\n";
            }
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
