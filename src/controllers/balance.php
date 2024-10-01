<?php

require_once("database.php");

function getBalancesByUserId($id)
{
    if (!$id) {
        return false;
    }
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT coins.symbol as symbol, balances.quantity, balances.average_price, balances.investment_amount FROM balances JOIN coins ON balances.coin_id=coins.id WHERE user_id=:id; ");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $balances = $stmt->fetchAll();
    return $balances;
}

getBalancesByUserId(1);
