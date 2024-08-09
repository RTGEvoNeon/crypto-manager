<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Crypto-manager</title>
</head>
<body>

    <h2>Введите свои данные</h2>
    <form action="process.php" method="post">
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