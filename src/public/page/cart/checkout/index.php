<?php

use DB\OrdersQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$request = new Request();
$order_id = $request->getMetaOrThrow("order_id");
$order = OrdersQuery::create()
    ->findOneById($order_id);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Оплата</title>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
            integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
</head>
<body>
<!--HEADER-->
<?php require __DIR__ . "/../../site-content/header/index.php" ?>

<main>
    <div class="checkout">
        <div class="iphone">
            <div class="checkout_header">
                <h1>Оплата</h1>
            </div>

            <form action="" class="form" method="POST">
                <div class="card_container">
                    <div class="top_card">

                        <h2>Адрес доставки</h2>
                        <p class="card">
                            <?= $order->getAddress() ?>
                        </p>
                    </div>
                    <div class="top_card">

                        <h2>ФИО</h2>
                        <div class="card">
                            <?= $order->getFullName() ?>
                        </div>
                    </div>
                    <div class="top_card">

                        <h2>Квитанция</h2>
                        <div class="card">
                            <address>
                                <?= $order->getEmail() ?>
                            </address>
                        </div>
                    </div>
                </div>

                <fieldset>
                    <legend>Способ оплаты</legend>

                    <div class="form__radios">
                        <div class="form__radio">
                            <label for="visa">
                                <svg class="icon">
                                    <use xlink:href="#icon-visa"/>
                                </svg>
                                Тестовая оплата</label>
                            <input checked id="visa" name="payment-method" type="radio"/>
                        </div>

                        <div class="form__radio" style="background-color: #d2d0d0; opacity: .5">
                            <label for="paypal">
                                <svg class="icon">
                                    <use xlink:href="#icon-paypal"/>
                                </svg>
                                SBER ID</label>
                            <input id="paypal" name="payment-method" type="radio" disabled/>
                        </div>

                        <div class="form__radio"  style="background-color: #d2d0d0; opacity: .5">
                            <label for="mastercard">
                                <svg class="icon">
                                    <use xlink:href="#icon-mastercard"/>
                                </svg>
                                QIWI</label>
                            <input id="mastercard" name="payment-method" type="radio" disabled/>
                        </div>
                    </div>
                </fieldset>

                <div>
                    <h2>Счёт</h2>

                    <?php

                    $products = $order->getOrderProductss();

                    if ($products->isEmpty()) {
                        JsonOutput::error("Нет товаров в заказе");
                    }

                    $total_product_price = 0;


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
                        $total_product_price += doubleval($price) * $product->getQuantity();
                    }
                    ?>

                    <table>
                        <tbody>
                        <?php
                        foreach ($products as $product) {
                            $price = $product->getProducts()->getDiscountPrice() === null ? $product->getProducts()->getPrice() : $product->getProducts()->getDiscountPrice();
                            ?>
                            <tr>
                                <td>
                                    <?= $product->getProducts()->getName() ?>
                                    <?= strtoupper((string)$product->getProductSizes()?->getSize()) ?>
                                    <b>x<?= $product->getQuantity() ?></b>
                                </td>
                                <td align="right">₽<?= $price * $product->getQuantity() ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>Доставка: <?= $order->getDeliveryName() ?></td>
                            <td align="right">₽<?= $order->getDeliveryPrice() ?></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Итого</td>
                            <td align="right">₽<?= $total_product_price + doubleval($order->getDeliveryPrice()) ?></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div>
                    <button data-order-id="<?= $order->getId() ?>" id="pay_button" class="button button--full"
                            type="button">
                        <svg class="icon">
                            <use xlink:href="#icon-shopping-bag"/>
                        </svg>
                        Оплатить
                    </button>
                </div>
            </form>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none">

            <symbol id="icon-shopping-bag" viewBox="0 0 24 24">
                <path d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 18l1.529-13h2.222v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h2.222l1.529 13h-15.502z"/>
            </symbol>

            <symbol id="icon-mastercard" viewBox="0 0 33 33">
                <g fill="none"><circle cx="16" cy="16" r="16" fill="#FF8C00"/><path fill="#FFF" d="M22.59 19.445c.051.401-.063.556-.19.556s-.305-.155-.495-.465c-.19-.31-.267-.66-.165-.84.063-.117.203-.169.368-.104.33.13.457.633.482.853zm-1.777.88c.393.336.508.723.304 1.008a.664.664 0 01-.52.232.896.896 0 01-.597-.22c-.355-.31-.457-.827-.229-1.111a.489.489 0 01.407-.181c.203 0 .432.09.635.271zM7 14.894C7 9.981 10.91 6 15.734 6c4.825 0 8.735 3.982 8.735 8.894a9.074 9.074 0 01-1.231 4.564c-.026.039-.09.026-.102-.026-.304-2.185-1.612-3.387-3.516-3.749-.166-.026-.191-.13.025-.155.584-.052 1.409-.039 1.84.039a5.9 5.9 0 00.039-.686c0-3.245-2.59-5.882-5.777-5.882-3.186 0-5.776 2.637-5.776 5.882 0 3.246 2.59 5.883 5.776 5.883h.267a8.078 8.078 0 01-.115-1.59c.013-.362.09-.414.242-.13.8 1.41 1.942 2.677 4.177 3.18 1.828.415 3.656.893 5.624 3.44.177.22-.089.452-.292.271-2.006-1.81-3.834-2.405-5.497-2.405-1.867.014-3.136.26-4.419.26C10.91 23.79 7 19.806 7 14.893z"/></g>
            </symbol>

            <symbol id="icon-paypal" viewBox="0 0 33 33">
              <g fill="none" fill-rule="evenodd"><circle cx="16" cy="16" r="16" fill="#48B254" fill-rule="nonzero"/><path fill="#FFF" d="M22.681 7.368l.945.858-11.932 6.812-5.776-3.325.54-1.073 5.236 2.977 10.987-6.25zM20.279 6l1.268.644-9.853 5.632-4.588-2.602.782-.938 3.806 2.172L20.28 6zm4.184 3.111l.701.939-13.47 7.697-6.505-3.701.297-1.18 6.208 3.54 12.769-7.295zm1.943 3.46c.396 1.109.594 2.27.594 3.486 0 1.216-.198 2.397-.594 3.54l-.27.725a11.142 11.142 0 01-2.348 3.486 10.85 10.85 0 01-3.51 2.307c-1.385.59-2.815.885-4.291.885-1.494 0-2.925-.295-4.293-.885a11.341 11.341 0 01-3.482-2.307 10.568 10.568 0 01-2.348-3.486c-.57-1.35-.865-2.8-.864-4.265v-.724l6.694 3.782 14.118-8.046.594 1.502z"/></g>
            </symbol>

            <symbol id="icon-visa" viewBox="0 0 504 504">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 356.92 356.92" style="enable-background:new 0 0 356.92 356.92;" xml:space="preserve">
<g>
    <path style="fill:#FF7876;" d="M329.419,282.653H27.5c-11.046,0-20-8.954-20-20V94.267c0-11.046,8.954-20,20-20h301.919   c11.046,0,20,8.954,20,20v168.386C349.419,273.699,340.465,282.653,329.419,282.653z"/>
    <rect x="46.46" y="112.267" style="fill:#FFDB77;" width="80" height="53"/>
    <g>
        <g>
            <path style="fill:#FFFFFF;" d="M94.87,256.428H49.96c-2.761,0-5-2.239-5-5V230.21c0-2.761,2.239-5,5-5h44.91c2.761,0,5,2.239,5,5     v21.219C99.87,254.19,97.631,256.428,94.87,256.428z"/>
        </g>
        <g>
            <path style="fill:#FFFFFF;" d="M165.566,256.428h-44.91c-2.761,0-5-2.239-5-5V230.21c0-2.761,2.239-5,5-5h44.91     c2.761,0,5,2.239,5,5v21.219C170.566,254.19,168.328,256.428,165.566,256.428z"/>
        </g>
        <g>
            <path style="fill:#FFFFFF;" d="M236.263,256.428h-44.91c-2.761,0-5-2.239-5-5V230.21c0-2.761,2.239-5,5-5h44.91     c2.762,0,5,2.239,5,5v21.219C241.263,254.19,239.024,256.428,236.263,256.428z"/>
        </g>
        <g>
            <path style="fill:#FFFFFF;" d="M306.96,256.428h-44.91c-2.761,0-5-2.239-5-5V230.21c0-2.761,2.239-5,5-5h44.91     c2.761,0,5,2.239,5,5v21.219C311.96,254.19,309.721,256.428,306.96,256.428z"/>
        </g>
    </g>
    <rect x="183.46" y="109.6" style="fill:#FFFFFF;" width="128.5" height="22.706"/>
    <g>
        <path style="fill:#414042;" d="M329.42,66.767H27.5c-15.163,0-27.5,12.336-27.5,27.5v168.386c0,15.163,12.337,27.5,27.5,27.5    h301.92c15.163,0,27.5-12.337,27.5-27.5V94.267C356.92,79.103,344.583,66.767,329.42,66.767z M341.92,262.653    c0,6.893-5.608,12.5-12.5,12.5H27.5c-6.893,0-12.5-5.607-12.5-12.5V94.267c0-6.893,5.607-12.5,12.5-12.5h301.92    c6.892,0,12.5,5.607,12.5,12.5V262.653z"/>
        <path style="fill:#414042;" d="M126.46,104.767h-80c-4.142,0-7.5,3.357-7.5,7.5v53c0,4.143,3.358,7.5,7.5,7.5h80    c4.142,0,7.5-3.357,7.5-7.5v-53C133.96,108.124,130.602,104.767,126.46,104.767z M118.96,157.767h-65v-38h65V157.767z"/>
        <path style="fill:#414042;" d="M311.96,102.1h-128.5c-4.142,0-7.5,3.357-7.5,7.5v22.706c0,4.143,3.358,7.5,7.5,7.5h128.5    c4.143,0,7.5-3.357,7.5-7.5V109.6C319.46,105.457,316.102,102.1,311.96,102.1z M304.46,124.806h-113.5V117.1h113.5V124.806z"/>
        <path style="fill:#414042;" d="M311.96,152.767h-128.5c-4.142,0-7.5,3.357-7.5,7.5s3.358,7.5,7.5,7.5h128.5    c4.143,0,7.5-3.357,7.5-7.5S316.102,152.767,311.96,152.767z"/>
        <path style="fill:#414042;" d="M311.96,179.767h-128.5c-4.142,0-7.5,3.357-7.5,7.5s3.358,7.5,7.5,7.5h128.5    c4.143,0,7.5-3.357,7.5-7.5S316.102,179.767,311.96,179.767z"/>
    </g>
</g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
            </symbol>
        </svg>

        <p style="color: #b4b4b4; font-weight: 100">Внимательно проверьте адрес доставки!</p>
    </div>
</main>

<br>
<br>
<br>

<!--FOOTER-->
<?php require __DIR__ . "/../../site-content/footer/index.php" ?>
</body>
</html>