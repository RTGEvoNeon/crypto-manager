<?php

require_once "database.php";

function getCoins()
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM coins");
    $stmt->execute();
    $coins = $stmt->fetchAll();
    return $coins;
}

function getCurrentPriceById($id)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT current_price FROM coins WHERE id=:id");
    $stmt->bindParam(":id", $id);
    if ($stmt->execute()) {
        return $stmt->fetch()["current_price"];
    }
    return 0;
}
