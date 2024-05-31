<?php

use DB\ProductsQuery;
use inc\v1\html_blocks\HtmlBlocks;
use inc\v1\request\Request;
use Propel\Runtime\ActiveQuery\Criteria;

$request = new Request();

if ($request->getMeta("q") === null) {
    header("Location: /");
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Поиск</title>

    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/mark.min.js"></script>

</head>
<body>

<!--HEADER-->
<?php require __DIR__ . "/../site-content/header/index.php" ?>

<main>
    <?php HtmlBlocks::textHeaderOne("По запросу «" . $request->getMeta("q") . "» найдено"); ?>


    <div class="grid_wrap">
        <div class="flex_wrap">
            <?php
            $products = ProductsQuery::create()
                ->filterByName("%" . $request->getMeta("q") . "%", Criteria::LIKE)
                ->find();

            foreach ($products as $product) {
                HtmlBlocks::productCard($product, true);
            }
            ?>
        </div>
    </div>
</main>
</body>
</html>
