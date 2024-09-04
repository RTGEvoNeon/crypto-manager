<?php
$conn_string = "
host=postgres
port=5432
dbname=crypto
user=user
password=password
";
$conn = pg_connect($conn_string);

if ($conn) {
echo "Соединение успешно!";
} else {
echo "Не удалось подключиться к базе данных";
};

function add_transaction($symbol, $price, $amount) {
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

$transactions = pg_query($conn, "SELECT coins.symbol as symbol, transactions.price as price, transactions.amount as amount FROM transactions JOIN coins ON transactions.coin_id=coins.id WHERE user_id = 1;");

pg_close($conn);
?>