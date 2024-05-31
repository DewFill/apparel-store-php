<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Бренды</title>

    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/site-content/products/style.css">
    <script defer src="/site-content/products/rating_setter.js"></script>
    <script defer src="/site-content/products/favorite_setter.js"></script>
    <script defer src="/site-content/products/add_product_to_cart.js"></script>
</head>
<body>

<!--HEADER-->
<?php

use DB\BrandsQuery;
use inc\v1\html_blocks\HtmlBlocks;

require __DIR__ . "/../site-content/header/index.php";
?>
<main>
    <?php
    $is_products_found = false;

    $brands = BrandsQuery::create()->find();

    //отображение названия брендов
    foreach ($brands as $brand) {
        $products = $brand->getProductss();

//отображение карточек товаров
        if ($products->count() > 0) {
            HtmlBlocks::textHeaderOne($brand->getName(), "#fffc9e");
            ?>
            <div class="grid_wrap">
                <div class="flex_wrap">
                    <?php
                    foreach ($products as $product) {
                        $is_products_found = true;
                        HtmlBlocks::productCard($product, true);
                    } ?>
                </div>
            </div>
        <?php }
    }

    if ($brands->isEmpty() or !$is_products_found) {
        HtmlBlocks::textHeaderOne("Бренды");
        ?>
        <div class="empty_container"
             style="width: 100%; display: flex; flex-flow: column; align-items: center">
            <h1 style="width: 100%; text-align: center; margin: 100px 0 100px 0">Бренды не найдены</h1>
            <h3 style="width: 90%; text-align: center; margin-bottom: 100px"></h3>
        </div>
    <?php } ?>
</main>

<!--FOOTER-->
<?php require __DIR__ . "/../site-content/footer/index.php" ?>
</body>
</html>
