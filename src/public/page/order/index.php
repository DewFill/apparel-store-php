<?php

use DB\OrdersQuery;
use inc\v1\auth\Auth;
use inc\v1\html_blocks\HtmlBlocks;

$order = OrdersQuery::create()
    ->filterByUserId(Auth::getUser()->id())
    ->filterById($_GET['order_id'])
    ->findOne();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artemy Apparel</title>
    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
</head>
<body>
<!--HEADER-->
<?php

require __DIR__ . "/../site-content/header/index.php" ?>

<main>
    <div class="bag_container">
        <?php

        if ($order === null) { ?>
            <h2 style="text-align: center; margin: 70px auto 0; width: fit-content">Заказ не найден</h2>
        <?php } else {
            HtmlBlocks::textHeaderOne("Заказ #" . $order->getId());

            $products = $order->getOrderProductss();

            $total_price = 0;

            foreach ($products as $product) {

                $quantity = 0;

                foreach ($products as $product_counter) {
                    if ($product_counter->getId() === $product->getId()) {
                        $quantity += $product_counter->getQuantity();
                    }
                }

                if ($product->getProducts()->getDiscountPrice() === null) {
                    $price = $product->getProducts()->getPrice();
                } else {
                    $price = $product->getProducts()->getDiscountPrice();
                }
                $total_price += doubleval($price) * $product->getQuantity();
                ?>
                <div class="bag_row_container">
                    <img class="item_img img_container" style="box-shadow: -15px -15px 0 -0px #ffcec3;"
                         src="/api/v1/product/main_image?product_id=<?= $product->getProducts()->getId() ?>/" alt="Товар
                     1">
                    <div class="body_container">
                        <h3 class="item_producer">
                            <?= $product->getProducts()->getBrands()?->getName() ?>
                        </h3>
                        <div class="grid_wrap_2x2">
                            <h2 class="item_name">
                                <?= $product->getProducts()->getName() ?>
                            </h2>
                            <h2 class="item_size">
                                <?= strtoupper((string)$product->getProductSizes()?->getSize()) ?>
                            </h2>
                            <?php if ($product->getProducts()->getDiscountPrice() === null) { ?>
                                <h2 class="item_price">
                                    ₽<?= (doubleval($product->getProducts()->getPrice()) * $product->getQuantity()) ?>
                                </h2>
                                <?php
                            } else { ?>
                                <h2 class="item_new_price">
                                    ₽<?= doubleval($product->getProducts()->getDiscountPrice()) * $product->getQuantity() ?>
                                </h2>
                            <?php }
                            ?>
                            <div class="count_of_items">
                                <label for="items_count">
                                    Кол-во:
                                </label>
                                <div><?= $quantity ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="not_enough_data">
                <h1><?= $order->getStatus() === "completed" ? "Завершён" : "В обработке" ?></h1>
                <div class="alert">Заказ # <?= $order->getId() ?></div>
                <p>Адрес: <?=$order->getAddress()?></p>
                <p>Дата: <?=$order->getDate()->format("d-m-Y")?></p>
                <p>ФИО: <?=$order->getFullName()?></p>
                <p>Доставка: <?=$order->getDeliveryName()?></p>
                <p>Стоимость доставки: <?=$order->getDeliveryPrice()?></p>
                <h3 style="margin-top: 10px">Итого: ₽<?= $total_price + doubleval($order->getDeliveryPrice()) ?></h3>
            </div>
        <?php } ?>
    </div>
</main>

<?php require __DIR__ . "/../site-content/footer/index.php" ?>
</body>
</html>