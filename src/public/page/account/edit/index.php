<?php

use DB\UsersQuery;
use inc\v1\auth\Auth;
use inc\v1\content\Content;
use inc\v1\html_blocks\HtmlBlocks;

$user = UsersQuery::create()->findOneById(Auth::getUserOrThrow()->id());
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактировать аккаунт</title>

    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
</head>
<body>

<!--HEADER-->
<?php
require __DIR__ . "/../../site-content/header/index.php" ?>
<main>
    <?= HtmlBlocks::textHeaderOne("Редактирование аккаунта") ?>
    <form action="#" id="edit_account_form">
        <div class="columns">
            <div class="column">
                <div class="block">
                    <label for="name">Имя: <span>*</span></label>
                    <input type="text" name="name" id="name" required value="<?= $user->getName() ?>">
                </div>
                <div class="block">
                    <label for="surname">Фамилия: <span>*</span></label>
                    <input type="text" name="surname" id="surname" required value="<?= $user->getSurname() ?>">
                </div>
                <div class="block">
                    <label for="patronymic">Отчество: <span>*</span></label>
                    <input type="text" name="patronymic" id="patronymic" required value="<?= $user->getPatronymic() ?>">
                </div>
            </div>

            <div class="column">
                <div class="block">
                    <label for="email">email: <span>*</span></label>
                    <input type="email" name="email" id="email" required value="<?= $user->getEmail() ?>">
                </div>
                <div class="block">
                    <label for="phone_number">Номер телефона:</label>
                    <input type="tel" name="phone_number" id="phone_number" value="<?= $user->getPhoneNumber() ?>">
                </div>
                <div class="block">
                    <label for="username">Юзернейм:</label>
                    <input type="text" name="username" id="username" value="<?= $user->getUsername() ?>">
                </div>
            </div>
        </div>

        <div class="address_block">
            <label for="main_address">Адрес по умолчанию:</label>
            <div class="address_input">
                <?php
                $addresses = $user->getUserAdressessRelatedByUserId();
                if ($addresses->count() === 0) { ?>
                    <a href="/account/addresses/add/" id="add_new_address_a">
                        <button id="add_new_address_button" type="button">Добавить адрес</button>
                    </a>
                <?php } else { ?>
                    <select name="main_address" id="main_address">
                        <?php foreach ($addresses as $address) { ?>
                            <option value="<?= $address->getId() ?>"
                                <?= $address->getId() === $user->getMainAddressId() ? "selected" : "" ?>>
                                <?= Content::addressStringBuilder($address) ?>
                            </option>
                        <?php } ?>
                    </select>
                <?php } ?>
            </div>
        </div>
        <div class="button_container">
            <button type="submit" id="save_data_button">Сохранить</button>
        </div>
        <a style="color: darkblue; text-decoration: underline" href="/account/edit/password/">Сменить пароль</a>
    </form>

</main>

<?php require __DIR__ . "/../../site-content/footer/index.php" ?>
</body>
</html>
