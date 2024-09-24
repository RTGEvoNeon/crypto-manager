<?php
require_once 'user.php';
if (isset($_POST)) {
    if ($_POST['password'] == $_POST['check']) {
        addUser($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["password"]);
        echo "Пользователь " . $_POST["first_name"] . " зарегистрирован!";
    } else {
        echo "Пароли не совпадают";
    }
}
