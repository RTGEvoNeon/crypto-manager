<?php

require_once("database.php");

function getBalancesByUserId($id)
{
    if (!$id) {
        return false;
    }
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM balances WHERE user_id=:id;");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $balances = $stmt->fetchAll();
    return $balances;
}

header('Content-Type: application/json');
echo json_encode(getBalancesByUserId(1), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
