<?php

use DB\OrdersQuery;
use inc\v1\html_blocks\HtmlBlocks;

function randomUuid(): string
{
    $data = \openssl_random_pseudo_bytes(9);
    // set the version to 0100
    $data[6] = \chr(\ord($data[6]) & 0x0f | 0x40);
    // set bits 6-7 to 10
    $data[8] = \chr(\ord($data[8]) & 0x3f | 0x80);

    return strtoupper(\vsprintf('%s-%s-%s', \str_split(\bin2hex($data), 4)));
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заказы</title>

    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
</head>
<body>
<!--HEADER-->
<?php

require __DIR__ . "/../../../static/admin/header/index.php" ?>
<?php $status = $_GET["status"] ?? null ?>
<main>
    <?= HtmlBlocks::textHeaderOne("Заказы пользователей", "#6565af") ?>

    <div class="container">
        <div class="orders">
            <?php
            if (!empty($_GET["status"]) and $_GET["status"] === "placed/") {
                $orders = OrdersQuery::create()->findByStatus("placed");
            } elseif (!empty($_GET["status"]) and $_GET["status"] === "completed/") {
                $orders = OrdersQuery::create()->findByStatus("completed");
            } else {
                $orders = OrdersQuery::create()->orderByStatus()->find();
            } ?>
            <label class="order_label">
                <select name="orders_selector" id="orders_selector">
                    <option value="all" <?= $status !== "placed/" and $status !== "completed/" ? "selected" : "" ?>>
                        Все заказы
                    </option>
                    <option value="placed" <?= $status === "placed/" ? "selected" : "" ?>>
                        В обработке
                    </option>
                    <option value="completed" <?= $status === "completed/" ? "selected" : "" ?>>
                        Завершённые
                    </option>
                </select>
            </label>
            <?php if ($orders->isEmpty()) { ?>
                <h1 style="margin-top: 90px">Заказы не найдены</h1>
            <?php }

            foreach ($orders as $order) { ?>
                <div class="order">
                    <div class="wrap_text">
                        <div class="date">
                            <div>Дата:</div>
                            <div><?= $order->getDate()->format("d-m-Y") ?></div>
                        </div>

                        <div class="track_number">
                            <div>ФИО:</div>
                            <div>
                                <?= $order->getFullName() ?>
                            </div>
                        </div>
                        <div class="address">
                            <div>Адрес:</div>
                            <div>
                                <?= $order->getAddress() ?>
                            </div>
                        </div>

                        <div class="status">
                            <div>Статус:</div>
                            <div><?= $order->getStatus() === "completed" ? "Завершён" : "В обработке" ?></div>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="/admin/order?order_id=<?= urlencode($order->getId()) ?>/">
                            <button class="more">Подробнее</button>
                        </a>
                        <?php if ($order->getStatus() === "placed") { ?>
                            <button class="complete_button" data-order-id="<?= $order->getId() ?>">Завершить</button>
                        <?php } else { ?>
                            <button class="complete_button completed" data-order-id="<?= $order->getId()
                            ?>">Завершено
                            </button>
                        <?php } ?>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</main>
<br>
<br>
<br>
</body>
</html>