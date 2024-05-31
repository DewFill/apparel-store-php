<?php

use DB\UsersQuery;
use inc\v1\auth\Auth;

$user = UsersQuery::create()->findOneById(Auth::getUserOrThrow()->id());
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Аккаунт</title>

    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
</head>
<body>

<!--HEADER-->
<?php
require __DIR__ . "/../site-content/header/index.php" ?>
<main>
    <div class="wrap">
        <nav class="nav">
            <a href="/favorites/" class="nav_links">Избранные</a>
            <a href="/account/addresses/" class="nav_links">Книга адресов</a>
            <a href="/orders/" class="nav_links">История заказов</a>
            <a href="/account/edit/" class="nav_links">Редактировать профиль</a>
            <hr style="border: 1px solid black">
            <a href="/account/logout/" class="nav_links">Выйти из аккаунта</a>
        </nav>

        <div class="info">
            <p id="hello">Привет, <?php
                if ($user->getName() !== null) {
                    echo $user->getName();
                } else if ($user->getUsername() !== null) {
                    echo $user->getUsername();
                } else {
                    echo $user->getEmail();
                }
                ?>
            </p>
            <a href="/account/terminate/" id="delete_link">Удалить аккаунт</a>
            <div class="data">
                <p><?= $user->getEmail() ?></p>
            </div>
        </div>

        <div class="slider">
            <?php require __DIR__ . "/../site-content/slider/index.php" ?>
        </div>
    </div>
</main>

<?php require __DIR__ . "/../site-content/footer/index.php" ?>
</body>
</html>
