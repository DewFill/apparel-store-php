<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Удаление аккаунта</title>

    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
</head>
<body>
<?php use inc\v1\html_blocks\HtmlBlocks;

require __DIR__ . "/../../site-content/header/index.php" ?>
<main>
    <?=HtmlBlocks::textHeaderOne("Удаление аккаунта")?>
    <div class="delete_container">
        <p>Вы уверены, что хотите удалить свой аккаунт?</p>
        <form id="delete_form" action="" method="post">
            <input type="submit" value="Удалить" id="delete_button">
        </form>
    </div>
</main>
<?php require __DIR__ . "/../../site-content/footer/index.php" ?>
</body>
</html>