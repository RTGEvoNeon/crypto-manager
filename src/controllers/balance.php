<?php

require_once("database.php");

function getBalancesByUserId($id)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT coins.symbol as symbol, balances.quantity, balances.average_price, balances.investment_amount FROM balances JOIN coins ON balances.coin_id=coins.id WHERE user_id=:id; ");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $balances = $stmt->fetchAll();
    return $balances;
}

function getBalanceById($id)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM balances WHERE id=:id;");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetchAll()[0];
}

function updateBalance($id, array $data)
{
    $pdo = Database::getInstance()->getConnection();
    foreach ($data as $field => $value) {
        $stmt = $pdo->prepare("UPDATE balances SET $field = :value WHERE id = :id");
        $stmt->bindParam(":value", $value);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    return true;
}

print_r(getBalanceById(1));
