<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artemy Shop</title>
    <meta name="theme-color" content="#9CC2CE">
    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
</head>
<body>

<!--HEADER-->
<?php

use DB\ProductsQuery;
use inc\v1\html_blocks\HtmlBlocks;
use Propel\Runtime\ActiveQuery\Criteria;

require __DIR__ . "/../site-content/header/index.php" ?>


<!--SLIDER-->
<?php require __DIR__ . "/../site-content/slider/index.php" ?>


<main>
    <div class="grid_wrap">
        <div class="flex_wrap">
            <?php
            $products = ProductsQuery::create()->orderById(Criteria::DESC)->find();

            foreach ($products as $product) {
                HtmlBlocks::productCard($product, true);
            }
            ?>
        </div>
    </div>
</main>


<!--FOOTER-->
<?php require __DIR__ . "/../site-content/footer/index.php" ?>
</body>
</html>