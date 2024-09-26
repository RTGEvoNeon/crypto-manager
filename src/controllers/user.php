<?php
require_once 'database.php';

function addUser($first_name, $last_name, $email, $password)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password);");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    return $pdo->lastInsertId();
}
function deleteUser($id)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("DELETE FROM users WHERE users.id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return true;
}
function updateUser($id, array $data)
{
    $pdo = Database::getInstance()->getConnection();
    foreach ($data as $field => $value) {
        $stmt = $pdo->prepare("UPDATE users SET $field = :value WHERE users.id = :id");
        $stmt->bindParam(":value", $value);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    return true;
}
// }
