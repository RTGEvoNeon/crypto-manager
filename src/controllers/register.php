<?php
require_once 'user.php';

session_start();
// Проверяем, отправлена ли форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST)) {
        if ($_POST['password'] == $_POST['check']) {
            $user_id = addUser($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["password"]);
            $_SESSION['user_id'] = $user_id;
            header("Location: ../../../public/index.php");
            exit();
        } else {
            echo "Пароли не совпадают";
        }
    }
    // После успешной обработки, делаем редирект на главную страницу
}
