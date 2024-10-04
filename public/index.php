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
    <style>
        /* Стили для затемнения фона */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        /* Стили для модального окна */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        /* Кнопка закрытия */
        .close-btn {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <?php if (!empty($_SESSION)): ?>
        <p>Приветсвуем вас, наш дорогой <?= $_SESSION["first_name"] ?>!</p>
    <?php endif; ?>
    <h1>Crypto-Manager</h1>
    <form class="form" action="../src/controllers/register.php" method="POST">
        <h3>Регистрация</h3>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
        </div>
        <input class="input" type="text" name="first_name" placeholder="Имя">
        <input class="input" type="text" name="last_name" placeholder="Фамилия">
        <input class="input" type="email" name="email" placeholder="Почта">
        <input class="input" type="password" name="password" placeholder="Пароль">
        <input class="input" type="password" name="check" placeholder="Пароль еще раз">
        <button type="submit">Sign Up</button>
    </form>
    <form action="../src/controllers/auth.php" method="POST">
        <h3>Авторизация</h3>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <!-- <a href="#">Forget Your Password?</a> -->
        <button type="submit">Sign In</button>
    </form>

    <form action="../src/controllers/kill.php" method="POST">
        <button type="submit">Выйти из аккаунта</button>
    </form>


    </a>
    <br><br>
    <h2>Ваш портфель</h2>
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
            if (!empty($_SESSION)) {
                $balances = getBalancesByUserId($_SESSION['id']);
                foreach ($balances as $balance): ?>
                    <tr>
                        <td><?= htmlspecialchars($balance["symbol"]) ?></td>
                        <td><?= htmlspecialchars($balance["quantity"]) ?></td>
                        <td><?= htmlspecialchars($balance["average_price"]) ?></td>
                        <td><?= htmlspecialchars($balance["investment_amount"]) ?></td>
                        <td class="del-balance" id="<?= htmlspecialchars($balance["id"]) ?>">&times;</td>
                    </tr>
            <?php endforeach;
            }
            ?>
        </tbody>
    </table>
    <!-- Затемнение фона -->
    <div class="modal-overlay" id="modalOverlay"></div>

    <button id="openModalBtn">Добавить новую транзакцию</button>

    <div class="modal" id="modal">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <form class="form" action="../src/controllers/add_transaction.php" method="POST">
            <select name="coin_id">
                <?php $coins = getCoins();
                foreach ($coins as $coin): ?>
                    <option value=<?= htmlspecialchars($coin["id"]) ?>><?= htmlspecialchars($coin["symbol"]) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="type">
                <option value="buy">Покупка</option>
                <option value="sell">Продажа</option>
            </select>
            <input class="input" type="number" name="quantity" placeholder="Количество монет">
            <button class="btn" type="submit">Добавить монету</button>
        </form>
    </div>
    <script>
        document.getElementById("openModalBtn").addEventListener('click', function() {
            document.getElementById("modal").style.display = 'block';
            document.getElementById("modalOverlay").style.display = 'block';
        })

        document.getElementById("closeModalBtn").addEventListener('click', function() {
            document.getElementById("modal").style.display = 'none';
            document.getElementById("modalOverlay").style.display = 'none';

        })

        document.getElementById("modalOverlay").addEventListener('click', function() {
            document.getElementById("modal").style.display = 'none';
            document.getElementById("modalOverlay").style.display = 'none';

        });
    </script>
</body>

</html>