<?php

use DB\BrandsQuery;
use DB\UsersQuery;
use Delight\Auth\Role;
use inc\v1\html_blocks\HtmlBlocks;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование сайтов</title>
    <script type="module" defer src="Administrator.js"></script>
</head>
<body>
<?php require __DIR__ . "/../../../static/admin/header/index.php" ?>
<main>
<div>

<?= HtmlBlocks::textHeaderOne("Добавить администратора", "#6565af") ?>
    <form id="form_create">
        <label>
            email:
            <input type="text" name="user_name" required/>
        </label>
        <input type="submit" class="button" value="Загрузить"/>
        <div class="error"></div>
    </form>
    <br>
    <br>
    <br>

<?php
$admins = UsersQuery::create()->filterByRolesMask(Role::ADMIN)->find();

if ($admins->count() > 1) { ?>
    <?= HtmlBlocks::textHeaderOne("Удалить администратора", "#6565af") ?>

    <form id="form_delete">
        <label>
            <select>
                <?php
                $users = UsersQuery::create()
                    ->filterByRolesMask(Role::ADMIN)
                    ->find();
                foreach ($users as $user) {
                    $id = $user->getId();
                    $user_name = $user->getName();
                    $user_surname = $user->getSurname();
                    $user_patronymic = $user->getPatronymic();
                    echo "<option value='$id'>ID: $id | ФИО: $user_surname $user_name $user_patronymic</option>";
                }
                ?>
            </select>
        </label>
        <input type="submit" class="button" value="Удалить" id="but_delete">
        <div class="error"></div>
    </form>
<?php } ?>
</div>
</main>
</body>
</html>