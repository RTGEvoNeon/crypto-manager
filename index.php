<?php
    require_once 'process.php'
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Crypto-manager</title>
</head>
<body>
    <h1>Список транзакций:</h1>
    <table border="1">
        <tr>
            <th>Монета</th>
            <th>Цена покупки</th>
            <th>Количество</th>
        </tr>
    <?
    while ($row = $assets->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" . $row["symbol"] . "</td>";
            echo "<td>" . $row["purchase_price"] . "</td>";
            echo "<td>" . $row["amount"] . "</td>";
        echo "</tr>";
    }?>
    </table>   
    
    <h2>Добавить монету</h2>
    <form action="/" method="post">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="price">Цена:</label>
        <input type="text" id="price" name="price" required><br><br>
        <label for="count">Количество:</label>
        <input type="text" id="count" name="count" required><br><br>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>