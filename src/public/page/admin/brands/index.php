<?php

use DB\BrandsQuery;
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
    <script type="module" defer src="Brand.js"></script>
</head>
<body>
<?php require __DIR__ . "/../../../static/admin/header/index.php" ?>
<main>
<div>

<?= HtmlBlocks::textHeaderOne("Добавить бренд", "#6565af") ?>
    <form id="form_create">
        <label>
            <input type="text" name="brand_name" required/>
        </label>
        <input type="submit" class="button" value="Добавить"/>
        <div class="error"></div>
    </form>
    <p>Ссылка на бренд: <a class="brand_link" href="#"></a></p>
    <br>
    <br>
    <br>


    <?= HtmlBlocks::textHeaderOne("Удалить бренд", "#6565af") ?>

    <form id="form_delete">
        <label>
            <select>
                <?php
                $brands = BrandsQuery::create()->find();
                foreach ($brands as $brand) {
                    $id = $brand->getId();
                    $brand_name = $brand->getName();
                    echo "<option value='$id'>ID: $id | name: $brand_name</option>";
                }
                ?>
            </select>
        </label>
        <input type="submit" class="button" value="Удалить" id="but_delete">
        <div class="error"></div>
    </form>
    <br>
    <br>
    <br>


    <?= HtmlBlocks::textHeaderOne("Изменить бренд", "#6565af") ?>

    <form id="form_update">
        <label>
            <select>
                <?php
                $brands = BrandsQuery::create()->find();
                foreach ($brands as $brand) {
                    $id = $brand->getId();
                    $brand_name = $brand->getName();
                    echo "<option value='$id'>ID: $id | name: $brand_name</option>";
                }
                ?>
            </select>
        </label>
        <label>
            <input type="text" name="brand_name" required/>
        </label>
        <input type="submit" class="button" value="Изменить">
        <div class="error"></div>
    </form>
</div>
</main>
<br>
<br>
<br>
</body>
</html>