<?php

use DB\CategoriesQuery;
use DB\ProductCategoriesQuery;
use inc\v1\environment_variable\EnvironmentVariable;
use inc\v1\html_blocks\HtmlBlocks;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$category_id = $request->getMetaOrThrow('category_id');
$products_category = ProductCategoriesQuery::create()->findByCategoryId($category_id);
$category = CategoriesQuery::create()->findOneById($category_id);
$http_schema = EnvironmentVariable::instance()->get("APP_SCHEMA");
$domain = EnvironmentVariable::instance()->get("APP_DOMAIN");
?>

<!doctype html>
<html lang="ru">
<head>
    <link rel="canonical" href="<?= $http_schema ?>://<?= $domain ?>/category?category_id=<?= $category->getId() ?>/"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artemy Apparel</title>

    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
</head>
<body>
<!--HEADER-->
<?php require __DIR__ . "/../site-content/header/index.php" ?>
<main>
    <?= HtmlBlocks::textHeaderOne($category?->getName()) ?>
    <div class="grid_wrap">
        <div class="flex_wrap">
            <?php
            try {
                if ($products_category->count() === 0) { ?>
                    <div class="empty_container"
                         style="width: 100%; display: flex; flex-flow: column; align-items: center">
                        <h1 style="width: 100%; text-align: center; margin: 100px 0 100px 0">Категория пуста</h1>
                        <h3 style="width: 90%; text-align: center; margin-bottom: 100px"></h3>
                    </div>
                <?php } else {
                    foreach ($products_category as $product) {
                        HtmlBlocks::productCard($product->getProducts(), true);
                    }
                }
            } catch (PropelException $e) {
            }
            ?>
        </div>
    </div>
</main>
<!--FOOTER-->
<?php require __DIR__ . "/../site-content/footer/index.php" ?>

</body>
</html>