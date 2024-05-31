<?php

use DB\UsersQuery;
use inc\v1\auth\Auth;
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
    <title>Добавить адрес</title>
</head>
<body>

<!--HEADER-->
<?php require __DIR__ . "/../../../site-content/header/index.php" ?>
<main>
    <?= HtmlBlocks::textHeaderOne("Добавить адрес") ?>

    <div class="addresses">
        <form action="">

            <label>
                Регион: <span class="red">*</span>
                <input type="text" id="region" required>
            </label>
            <label>
                Город: <span class="red">*</span>
                <input type="text" id="city" required>
            </label>
            <label>
                Район: <span class="red">*</span>
                <input type="text" id="district" required>
            </label>
            <label>
                Улица: <span class="red">*</span>
                <input type="text" id="street" required>
            </label>
            <label>
                Индекс: <span class="red">*</span>
                <input type="text" id="zip_code" required>
            </label>
            <label>
                Дом: <span class="red">*</span>
                <input type="text" id="house" required>
            </label>
            <label>
                Квартира:
                <input type="text" id="apartment">
            </label>

                <button type="submit" class="add_address_button">Добавить адрес</button>
        </form>
    </div>
</main>

<?php require __DIR__ . "/../../../site-content/footer/index.php" ?>
</body>
</html>
