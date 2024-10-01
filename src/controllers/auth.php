<?php
require_once "database.php";
//TODO: доделать функцию, нет должного функционала
function auth($email, $password)
{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1;");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    return $stmt->fetchAll()[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    if ($_POST['email'] && $_POST['password']) {
        $user = auth($_POST['email'], $_POST['password']);
        foreach ($user as $key => $value) {
            $_SESSION[$key] = $value;
        }
        $_SESSION['session_id'] = session_id();
        header("Location: ../../../public/index.php");
        exit();
    }
}
