<?php

use DB\OrdersQuery;
use inc\v1\auth\Auth;
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

require __DIR__ . "/../site-content/header/index.php" ?>
<main>
    <div class="container" style="min-width: 90%">
        <?= HtmlBlocks::textHeaderOne("Заказы") ?>

        <div class="orders">
            <?php
            $orders = OrdersQuery::create()->findByUserId(Auth::getUserOrThrow()->id());

            foreach ($orders as $order) { ?>
                <div class="order">
                    <div class="wrap_text">
                        <div class="date">
                            <div>Дата:</div>
                            <div><?= $order->getDate()->format("d-m-Y") ?></div>
                        </div>

                        <div class="track_number">
                            <div>Трек-номер:</div>
                            <div>
                                <?= $track_number = randomUuid(); ?>
                            </div>
                        </div>

                        <div class="status">
                            <div>Статус:</div>
                            <div><?= $order->getStatus() === "completed" ? "Завершён" : "В обработке" ?></div>
                        </div>
                    </div>
                    <a href="/order?order_id=<?= urlencode($order->getId()) ?>/">
                        <button>Подробнее</button>
                    </a>
                    <a target="_blank" href="https://www.cdek.ru/ru/tracking?order_id=<?= urlencode($track_number) ?>">
                        <button>Отслеживать</button>
                    </a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</main>

<?php require __DIR__ . "/../site-content/footer/index.php" ?>
</body>
</html>