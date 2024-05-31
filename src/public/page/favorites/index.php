<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Избранные</title>

    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/site-content/products/style.css">
</head>
<body>

<!--HEADER-->
<?php

use DB\UserFavoritesQuery;
use inc\v1\auth\Auth;
use inc\v1\html_blocks\HtmlBlocks;

require __DIR__ . "/../site-content/header/index.php";?>

<main>
    <?php HtmlBlocks::textHeaderOne("Избранные"); ?>

    <?php

    $favorite_products = UserFavoritesQuery::create()
        ->filterByUserId(Auth::getUser()->id())
        ->find();

    if ($favorite_products->isEmpty()) { ?>
    <div class="empty_container" style="width: 100%; display: flex; flex-flow: column; align-items: center">
        <h1 style="width: 100%; text-align: center; margin: 100px 0 100px 0">Нет избранных</h1>
        <h3 style="width: 90%; text-align: center; margin-bottom: 100px">Нажимайте на
            <style>
                svg {
                    transform: translateY(20%);
                }
            </style>
            <svg height="36" viewBox="0 0 36 36" width="36" xmlns="http://www.w3.org/2000/svg"><path d="m25.9683552
            9.21882515c3.2608181.80024215 5.5472476 3.70843205 5.5302621 7.02070785.0167706.8151169-.1192457 1.6262091-.4011081 2.3920749l-.0747211.2030295-12.8022428 9.8639172-12.75640108-9.9236157-.07145807-.2171752c-.24888993-.7564256-.38125398-1.5457388-.39268615-2.3532254.00533124-3.3241785 2.30112936-6.21297878 5.5578425-6.99897615 2.9473775-.7113402 5.994845.46537879 7.693908 2.88167155 1.7058655-2.42023178 4.7647874-3.59281834 7.7166047-2.86840855zm4.0304303 7.03234525c.0133197-2.6356293-1.7984492-4.9400818-4.3879391-5.5755723-2.5916285-.6360153-5.2853557.5658675-6.5186557 2.9056024l-.2109905.4002771h-1.2606673l-.2108023-.4010462c-1.2278635-2.3359801-3.9115803-3.5414353-6.4999721-2.9167351-2.58628854.6241925-4.40554267 2.913358-4.40983587 5.5313398.00812541.5692131.09284506 1.1345045.25168043 1.6810239l11.47335964 8.9254964 11.5331004-8.886064c.1708302-.531397.2523391-1.0890695.2407224-1.664322z"></path></svg>
            во время покупок, чтобы сохранить избранное</h3>
    </div>
    <?php } else { ?>

    <div class="grid_wrap">
        <div class="flex_wrap">

            <?php
            foreach ($favorite_products as $product) {
                $product = $product->getProducts();
                HtmlBlocks::productCard($product, true);
            } ?>

        </div>
    </div>
    <?php } ?>
</main>
<!--FOOTER-->
<?php require __DIR__ . "/../site-content/footer/index.php" ?>
</body>
</html>