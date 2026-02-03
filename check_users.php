<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1", "root", "", [PDO::ATTR_TIMEOUT => 2]);
    $stmt = $pdo->query("SELECT user, host FROM mysql.user");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($users);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
