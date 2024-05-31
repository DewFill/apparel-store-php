<?php use DB\CartProductsQuery;
use DB\UsersQuery;
use inc\v1\auth\Auth;
use inc\v1\content\Content;
use inc\v1\html_blocks\HtmlBlocks;
use Propel\Runtime\Exception\PropelException;
//$auth = Auth::getUserOrThrow();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bag.css">
    <title>Корзина</title>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="item.js"></script>
<script type="module" src="product_remover.js"></script>
<script type="module" src="product_count_setter.js"></script>
<body>
<!--HEADER-->
<?php require __DIR__ . "/../site-content/header/index.php" ?>

<main>
    <div class="bag_container">
        <?= HtmlBlocks::textHeaderOne("Корзина") ?>
        <?php
        $cart_products = CartProductsQuery::create()
            ->filterByUserId(Auth::getUser()->id())
            ->find();

        if ($cart_products->isEmpty()) { ?>
            <div class="empty_container" style="width: 100%; display: flex; flex-flow: column; align-items: center">
                <h1 style="width: 100%; text-align: center; margin: 100px 0 100px 0">Корзина пуста</h1>
                <h3 style="width: 90%; text-align: center; margin-bottom: 100px">Добавьте товар для продолжения</h3>
            </div>
        <?php } else {

        $total_price = 0;

        foreach ($cart_products as $cart_product) {

            $quantity = 0;

            foreach ($cart_products as $product_counter) {
                if ($product_counter->getId() === $cart_product->getId()) {
                    $quantity += $product_counter->getQuantity();

                }
            }

            if ($cart_product->getProducts()->getDiscountPrice() === null) {
                $price = $cart_product->getProducts()->getPrice();
            } else {
                $price = $cart_product->getProducts()->getDiscountPrice();
            }
            $total_price += doubleval($price) * $cart_product->getQuantity();
            ?>
            <div class="bag_row_container">
                <img class="item_img img_container" style="box-shadow: -15px -15px 0 -0px #ffcec3;"
                     src="/api/v1/product/main_image?product_id=<?= $cart_product->getProducts()->getId() ?>/" alt="Товар
                     1">
                <div class="body_container">
                    <h3 class="item_producer">
                        <?= $cart_product->getProducts()->getBrands()?->getName() ?>
                    </h3>
                    <div class="grid_wrap_2x2">
                        <h2 class="item_name">
                            <?= $cart_product->getProducts()->getName() ?>
                        </h2>
                        <h2 class="item_size">
                            <?= strtoupper((string)$cart_product->getProductSizes()?->getSize()) ?>
                        </h2>
                        <?php if ($cart_product->getProducts()->getDiscountPrice() === null) { ?>
                            <h2 class="item_price">
                                ₽<?= (doubleval($cart_product->getProducts()->getPrice()) * $cart_product->getQuantity()) ?>
                            </h2>
                            <?php
                        } else { ?>
                            <h2 class="item_new_price">
                                ₽<?= doubleval($cart_product->getProducts()->getDiscountPrice()) * $cart_product->getQuantity() ?>
                            </h2>
                        <?php }
                        ?>
                        <div class="count_of_items">
                            <label for="items_count">
                                Кол-во:
                            </label>
                            <label>
                                <input type="number" value="<?= $quantity ?>" min="1" max="99" step="1"
                                       name="items_count"
                                       class="items_count" data-cart-product-id="<?= $cart_product->getId() ?>">
                            </label>
                        </div>
                        <div class="options_container">
                            <!--                            <img src="/static/image/cart/heart_ico.svg" alt="Лайкнуть">-->

                            <img class="button_remove_product"
                                 data-product-id="<?= $cart_product->getProducts()->getId() ?>"
                                 src="/static/image/cart/trash_ico.svg" alt="Убрать товар из корзины"></div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php
        $user = UsersQuery::create()->findOneById(Auth::getUser()->id());
        $has_name = $user->getName() !== null;
        $has_surname = $user->getSurname() !== null;
        $has_patronymic = $user->getPatronymic() !== null;
        $has_email = $user->getEmail() !== null;

        try {
            $has_address = $user->getUserAdressessRelatedByUserId()->count() > 0;
        } catch (PropelException $e) {
            $has_address = false;
        }

        $has_all = ($has_name and $has_surname and $has_patronymic and $has_email and $has_address);

        $data_to_fill_text = (function () use ($has_address, $has_email, $has_patronymic, $has_surname, $has_name) {
            $data = [];
            if (!$has_name) {
                $data[] = "<b>Имя</b>";
            }
            if (!$has_surname) {
                $data[] = "<b>Фамилия</b>";
            }
            if (!$has_patronymic) {
                $data[] = "<b>Отчество</b>";
            }
            if (!$has_email) {
                $data[] = "<b>Email</b>";
            }
            if (!$has_address) {
                $data[] = "<b>Адрес</b>";
            }
            return implode(", ", $data);
        })();

        if ($has_all === false) { ?>
            <div class="not_enough_data">
                <div class="alert">Для продолжения заказа необходимо заполнить следующие
                    данные: <?= $data_to_fill_text ?></div>
                <div class="button_container">
                    <?php
                    if (!$has_name or !$has_surname or !$has_patronymic or !$has_email) {
                        ?>
                        <a href="/account/edit/">
                            <button>Добавить личные данные</button>
                        </a>
                        <?php
                    }

                    if (!$has_address) {
                        ?>
                        <a href="/account/addresses/add/">
                            <button>Добавить адрес</button>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        <?php } elseif (!$cart_products->isEmpty()) { ?>
            <form class="order_wrapper">
                <div class="order_container">
                    <h2>Оформить заказ</h2>
                    <div class="user_data">
                        <div>
                            <div>ФИО: </div>
                            <div> <?= "{$user->getSurname()} {$user->getName()} {$user->getPatronymic()}" ?></div>
                        </div>
                        <div>
                            <div>Email: </div>
                            <div> <?= $user->getEmail() ?></div>
                        </div>
                    </div>

                    <div class="delivery_type">
                        <div>Тип доставки:</div>
                        <div class="form_radio_btn">
                            <input class="delivery_radio" type="radio" name="delivery_type" value="general" id="general"
                                   checked>
                            <label for="general">Обычная</label>
                        </div>
                        <div class="form_radio_btn">
                            <input class="delivery_radio" type="radio" name="delivery_type" value="premium" id="premium">
                            <label for="premium">Быстрая</label>
                        </div>
                    </div>

                    <div class="addresses">
                        <label for="main_address">Адрес доставки:</label>
                        <select name="main_address" id="main_address">
                            <?php
                            $addresses = $user->getUserAdressessRelatedByUserId();

                            foreach ($addresses as $address) { ?>
                                <option id="option_address" value="<?= $address->getId() ?>"
                                    <?= $address->getId() === $user->getMainAddressId() ? "selected" : "" ?>>
                                    <?= Content::addressStringBuilder($address) ?>
                                </option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <button type="submit" id="place_order_button">Оформить заказ</button>
                </div>
                <div>Сумма товаров: ₽<?= $total_price ?></div>

            </form>
        <?php }} ?>
    </div>
</main>

<br>
<br>
<br>
<br>
<br>
<?php require __DIR__ . "/../site-content/footer/index.php" ?>
</body>
</html>