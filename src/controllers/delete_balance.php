<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем ID из POST-запроса
    $id = $_POST['id'];

    deleteBalanceById($id);
    header("Location: ../../public/index.php");
    exit();
} else {
    echo "Ошибка";
}
