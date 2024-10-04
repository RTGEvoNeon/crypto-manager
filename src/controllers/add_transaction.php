<?php
require_once "coin.php";
require_once "transactions.php";
session_start();
if (isset($_POST)) {
    $coin_id = $_POST["coin_id"];
    $type = $_POST["type"];
    $quantity = (float) $_POST["quantity"];
    $user_id = $_SESSION["id"];
    $price = getCurrentPriceById($coin_id);
    if (addTransaction($user_id, $coin_id, $type, $quantity, $price)) {
        header("Location: ../../public/index.php");
        exit();
    } else {
        echo "Ошибка добавления транзакции";
    }
} else {
    echo "Переменная POST не определенна!";
}
