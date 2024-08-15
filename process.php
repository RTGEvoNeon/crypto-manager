<?php
$db = ['MySQL-5.7', 'root', '', "crypto"];
$conn = mysqli_connect(...$db);
if (!$conn) {
    die("Подключение с базой данных не прошло!");
}

function add_asset($symbol, $price, $count) {
    global $conn;
    $name = "\"" . $symbol . "\"";
    if ($res =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM coins WHERE symbol = $name"))) {    
        $coin_id =  $res['id'];
        $request =  "INSERT INTO assets(user_id, coin_id, amount, purchase_price) VALUES(1, $coin_id, $count, $price);";        
        mysqli_query($conn, $request);    
    } else {
        $current_price = 100;
        $query = "INSERT INTO coins(name, symbol, current_price) VALUES('$name', '$symbol', $current_price);";
        mysqli_query($conn, $query);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $count = htmlspecialchars($_POST['count']);
    add_asset($name, $price, $count);
}

$assets = mysqli_query($conn, "SELECT coins.symbol, assets.purchase_price, assets.amount FROM assets JOIN coins ON assets.coin_id=coins.id WHERE user_id = 1;");
mysqli_close($conn);
?>