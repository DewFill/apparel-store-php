<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

use inc\v1\html_blocks\HtmlBlocks;

require __DIR__ . "/../../../site-content/header/index.php" ?>
<?= HtmlBlocks::textHeaderOne("Изменение пароля") ?>
<main>
    <form action="#" method="post" id="change_password_form">
        <label for="old_password">Старый пароль: <span>*</span></label>
        <input required type="password" name="old_password" id="old_password" autocomplete="current-password">

        <label for="new_password">Новый пароль: <span>*</span></label>
        <input required type="password" name="new_password" id="new_password" autocomplete="new-password">

        <label for="new_password_repeat">Повторите новый пароль: <span>*</span></label>
        <input required type="password" name="new_password" id="new_password_repeat" autocomplete="new-password">
        <button type="submit" id="change_password_button">Поменять пароль</button>
    </form>

    <p style="color: red; text-align: center" id="error_text"></p>
</main>
</body>
</html>