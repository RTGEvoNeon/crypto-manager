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
        $result = $stmt->fetchAll();
        if ($result) {
            $balance = $result[0];
            $update_balance = [];
            switch ($type) {
                case "buy":
                    $update_balance['quantity'] = $balance['quantity'] + $quantity;
                    $update_balance['investment_amount'] = $balance["investment_amount"] + $quantity * $price;
                    $update_balance['average_price'] = $update_balance['investment_amount'] / $update_balance['quantity'];
                    return updateBalance($balance["id"], $update_balance);
                    break;
                case "sell":
                    if ($balance['quantity'] >= $quantity) {
                        $update_balance['quantity'] = $balance['quantity'] - $quantity;
                        if ($update_balance['quantity'] == 0) {
                            return deleteBalanceById($balance["id"]);
                        }
                        $update_balance['investment_amount'] = $balance["investment_amount"] - $quantity * $price;
                        $update_balance['average_price'] = $update_balance['investment_amount'] / $update_balance['quantity'];
                        return updateBalance($balance["id"], $update_balance);
                    } else {
                        return false;
                    }
            }
        } else {
            if ($type == "buy") {
                addBalance($user_id, $coin_id, $quantity, $price, $price * $quantity);
                return true;
            } else {
                return false;
            }
        }
    }
    return false;
}

function deleteTransactions($user_id, $coin_id)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("DELETE from transactions WHERE coin_id=:coin_id and user_id=:user_id");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":coin_id", $coin_id);
    $stmt->execute();
    return true;
}

// addTransaction(7, 9, "buy", 123, 1);
