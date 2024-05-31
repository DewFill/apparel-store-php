<?php

use DB\OrdersQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$request = new Request();
$order = OrdersQuery::create()->findOneById($request->getMetaOrThrow('order_id'));

if ($order === null) {
    JsonOutput::error("Заказ не найден");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artemy Apparel</title>
</head>
<body>
<div class="container space-2 space-lg-3">
    <div class="w-md-80 w-lg-50 text-center mx-md-auto">
        <figure id="iconChecked" class="ie-height-90 max-width-11 mx-auto mb-3" style="">

            <?php
            if ($order->getStatus() === 'completed') { ?>
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                 viewBox="0 0 25.6 25.6" xml:space="preserve"
                 class="injected-svg js-svg-injector" data-parent="#iconChecked">
                    <style type="text/css">
                        .checked-icon-0 {
                            fill: #00C9A7;
                        }
                    </style>
                <path class="checked-icon-0 fill-success"
                      d="M12.8,0C5.7,0,0,5.7,0,12.8s5.7,12.8,12.8,12.8s12.8-5.7,12.8-12.8S19.9,0,12.8,0z M19.5,8.8L12.7,19  c-0.2,0.3-0.5,0.5-0.8,0.5s-0.7-0.2-0.9-0.4l-4-4c-0.3-0.3-0.3-0.7,0-1l1-1c0.3-0.3,0.7-0.3,1,0l2.6,2.6l5.7-8.4  c0.2-0.3,0.7-0.4,1-0.2l1.2,0.8C19.7,8.1,19.8,8.5,19.5,8.8z"></path>
</svg>

        </figure>
        <div class="mb-5">
            <h1 class="h3 font-weight-medium" style="margin-bottom: 10px">Ваш заказ был оформлен!</h1>
            <p style="margin-bottom: 20px">Спасибо за заказ! Ваш заказ обрабатывается и будет отправлен в течение
                3-6 часов. Вы получите уведомление о завершении заказа на почту.</p>
        </div>
        <a class="btn btn-primary btn-pill transition-3d-hover px-5"
           href="/order?order_id=<?= $request->getMeta("order_id") ?>/">
            Перейти к заказу</a>
        <?php }

        if ($order->getStatus() === 'placed') { ?>
            <img class="ie-height-90 max-width-11 mx-auto mb-3" src="/cart/checkout/complete/hourglass.png"
                 alt="hourglass">

            </figure>
            <div class="mb-5">
                <h1 class="h3 font-weight-medium" style="margin-bottom: 10px">Ваш заказ в обработке!</h1>
                <p style="margin-bottom: 20px">Спасибо за заказ! Вы получите уведомление о начале обработки заказа на
                    почту.</p>
            </div>
            <a class="btn btn-primary btn-pill transition-3d-hover px-5"
               href="/order?order_id=<?= $request->getMeta("order_id") ?>/">
                Перейти к заказу</a>
        <?php }
        ?>
    </div>
</div>
</body>
</html>