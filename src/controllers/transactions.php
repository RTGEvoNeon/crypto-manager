<?php

require_once 'database.php';


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
    return $stmt->execute();
}
