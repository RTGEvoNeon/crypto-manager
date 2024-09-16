<?php
$dsn = 'mysql:host=db;dbname=crypto_db';

$username = 'crypto_user';
$password = 'password';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = 'SELECT * FROM coins';
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();
echo json_encode($rows, JSON_PRETTY_PRINT);
