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
    //true | false
    if ($stmt->execute()) {
        $balance_id = $pdo->lastInsertId();

        $balance = getBalanceById($balance_id);
        $update_balance = [];
        $update_balance['quantity'] = $balance['quantity'] + $quantity;
        $update_balance['investment_amount'] = $balance["investment_amount"] + $quantity * $price;
        $update_balance['average_price'] = $update_balance['investment_amount'] / $update_balance['quantity'];
        return updateBalance($balance_id, $update_balance);
    }
}

addTransaction(1, 1, "Buy", 1, 100);
