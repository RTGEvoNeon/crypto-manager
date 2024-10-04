<?php

require_once 'database.php';
require_once 'balance.php';


function addTransaction($user_id, $coin_id, $type, $quantity, $price)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("INSERT INTO transactions(user_id, coin_id, type, quantity, price) VALUES(:user_id, :coin_id, :type, :quantity, :price)");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":coin_id", $coin_id);
    $stmt->bindParam(":type", $type);
    $stmt->bindParam(":quantity", $quantity);
    $stmt->bindParam(":price", $price);

    if ($stmt->execute()) {
        $stmt = $pdo->prepare("SELECT * from balances WHERE coin_id=:coin_id and user_id=:user_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":coin_id", $coin_id);
        $stmt->execute();
        $balance = $stmt->fetchAll()[0];

        $update_balance = [];
        $update_balance['quantity'] = $balance['quantity'] + $quantity;
        $update_balance['investment_amount'] = $balance["investment_amount"] + $quantity * $price;
        $update_balance['average_price'] = $update_balance['investment_amount'] / $update_balance['quantity'];
        return updateBalance($balance["id"], $update_balance);
    }
}
