<?php

require_once "database.php";

//TODO: доделать функцию, нет должного функционала
function auth($login, $password)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("EXISTS(SELECT id FROM users WHERE login=:login and password=:password)");
    $stmt->bindParam(":login", $login);
    $stmt->bindParam(":password", $password);
}
