

<?php

session_start();

if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coin = htmlspecialchars($_POST['coin']);
    $count = htmlspecialchars($_POST['count']);
    $_SESSION['data'][] = array($coin, $count); 
}
print_r($_SESSION['data']);
?>

