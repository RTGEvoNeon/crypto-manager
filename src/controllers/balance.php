<?php

require_once("database.php");
require_once("transactions.php");

function getBalancesByUserId($id)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT balances.id, coins.symbol as symbol, balances.quantity, balances.average_price, balances.investment_amount FROM balances JOIN coins ON balances.coin_id=coins.id WHERE user_id=:id; ");
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
    $stmt = $pdo->prepare("UPDATE balances SET last_update = :value WHERE id = :id");
    $date = date('Y-m-d H:i:s');
    $stmt->bindParam(":value", $date);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return true;
}

function addBalance($user_id, $coin_id, $quantity, $average_price, $investment_amount)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("INSERT INTO balances(user_id, coin_id, quantity, average_price, investment_amount) VALUES(:user_id, :coin_id, :quantity, :average_price, :investment_amount)");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":coin_id", $coin_id);
    $stmt->bindParam(":quantity", $quantity);
    $stmt->bindParam(":average_price", $average_price);
    $stmt->bindParam(":investment_amount", $investment_amount);
    $stmt->execute();
    return true;
}

function deleteBalanceById($id)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT coin_id, user_id from balances WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetchAll()[0];
    $coin_id = $result["coin_id"];
    $user_id = $result["user_id"];

    $result = deleteTransactions($user_id, $coin_id);
    $stmt = $pdo->prepare("DELETE from balances WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return true;
}
