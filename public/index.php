<?php
require_once "../src/controllers/balance.php";
require_once "../src/controllers/coin.php";
session_start()
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Крипто-портфель</title>
</head>

<body>
    <?php
    if (isset($_SESSION["id"])) {
        print_r($_SESSION);
    } ?>
    <h1>Это только начало!</h1>
    <h2>Ваш портфель</h2>
    <a href="auth.html">
        <h3>Авторизация/Регистрация</h3>
    </a>
    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Количество</th>
                <th>Средняя цена</th>
                <th>Инвестиции</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $balances = getBalancesByUserId(1);
            foreach ($balances as $balance): ?>
                <tr>
                    <td><?= htmlspecialchars($balance["coin_id"]) ?></td>
                    <td><?= htmlspecialchars($balance["quantity"]) ?></td>
                    <td><?= htmlspecialchars($balance["average_price"]) ?></td>
                    <td><?= htmlspecialchars($balance["investment_amount"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form class="form" action="../src/controllers/add_transaction.php" method="POST">
        <select name="coin_id">
            <?php $coins = getCoins();
            foreach ($coins as $coin): ?>
                <option value=<?= htmlspecialchars($coin["id"]) ?>><?= htmlspecialchars($coin["symbol"]) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="type">
            <option value="Buy">Покупка</option>
            <option value="Sell">Продажа</option>
        </select>
        <input class="input" type="number" name="quantity" placeholder="Количество монет">
        <button class="btn" type="submit">Добавить монету</button>
    </form>
</body>

</html>