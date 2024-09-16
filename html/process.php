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

function add_transaction($symbol, $price, $amount)
{
    global $conn;
    if ($res =  pg_fetch_assoc(pg_query($conn, "SELECT * FROM coins WHERE symbol = '$symbol'"))) {
        $coin_id =  $res['id'];
        $request =  "INSERT INTO transactions(user_id, coin_id, amount, price) VALUES(1, $coin_id, $amount, $price);";
        pg_query($conn, $request);
    } else {
        $current_price = 40;
        $query = "INSERT INTO coins(name, symbol, current_price) VALUES('$name', '$symbol', $current_price);";
        pg_query($conn, $query);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $amount = htmlspecialchars($_POST['amount']);
    add_transaction($name, $price, $amount);
}
$query = "SELECT * FROM transactions;";
$transactions = $pdo->query($query);
