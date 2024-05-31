<?php

use DB\BrandsQuery;
use DB\ProductImagesQuery;
use DB\ProductRatingQuery;
use DB\ProductsQuery;
use inc\v1\auth\Auth;
use inc\v1\environment_variable\EnvironmentVariable;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$product = ProductsQuery::create()->findOneById((new Request())->getMetaOrThrow("product_id"));

if ($product === null) JsonOutput::error("Product not found");
$http_schema = EnvironmentVariable::instance()->get("APP_SCHEMA");
$domain = EnvironmentVariable::instance()->get("APP_DOMAIN");

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <link rel="canonical" href="<?= $http_schema ?>://<?= $domain ?>?product?product_id=<?= $product->getId() ?>/"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product->getName()) ?> - Artemy Apparel</title>
    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

    <!--    Название сайта-->
    <meta property="og:site_name" content="Artemy Apparel">
    <meta property="og:title" content="<?= htmlspecialchars($product->getName()) ?> - Artemy Apparel"/>
    <!--    Картинка товара-->
    <meta name="twitter:image"
          content="<?= $http_schema ?>://<?= $domain ?>/api/v1/product/main_image?product_id=<?= htmlspecialchars($product->getId())
          ?>/"/>
    <!--    Описание товара-->
    <meta property="og:description" content="<?= htmlspecialchars($product->getDescription()
        . ' '
        . $product->getCopmosition()) ?>"/>
</head>
<script defer src="rating_setter.js"></script>
<body>

<?php require __DIR__ . "/../site-content/header/index.php" ?>

<br>
<br>
<br>
<br>
<br>

<div class="item_container" data-product-id="<?= $product->getId() ?>">
    <div class="item_image_container">
        <div class="main_image">
            <img src="/api/v1/product/main_image?product_id=<?= $product->getId() ?>/" alt="main photo">
            <span class="back_container" style="background: #ffcec3;"></span>
        </div>
        <div class="multiply_img_container">
            <!--            MAIN IMAGE-->
            <img style="box-shadow: -20px -20px 0 -0px #ffcec3;"
                 src="/api/v1/product/main_image?product_id=<?= $product->getId() ?>/" alt="image 1">

            <!--            OTHER IMAGES-->
            <?php
            $images = ProductImagesQuery::create()->findByProductId($product->getId());

            foreach ($images as $image) { ?>
                <img src="/api/v1/product/image?product_image_id=<?= $image->getId() ?>/" alt="">
            <?php } ?>
        </div>
    </div>
    <div class="item_inform_container">
        <div class="top_item_container">
            <p class="article">
                <?= $product->getArticle() === null
                    ? "ID: " . $product->getId()
                    : "Артикул: " . $product->getArticle
                    () ?></p>
            <!--            <img src="/static/image/heart_ico.svg" alt="В избранное">-->
        </div>
        <a href="/brand?brand_id=<?= $product->getBrandId() ?>&name=<?= $product->getBrands()?->getName() ?>/">
            <p style="color: black; font-style: italic" class="brand_name">
                <?= $product->getBrandId() === null
                    ? ''
                    : BrandsQuery::create()->findOneById($product->getBrandId())->getName() ?>
            </p>
        </a>
        <h2 class="item_name">
            <?= $product->getName() ?>
        </h2>

        <?php
        $product_rating = (function () use ($product) {
            $product_ratings = ProductRatingQuery::create()->findByProductId($product->getId());

            if ($product_ratings->isEmpty()) {
                return 0;
            }

            $rating_array = [];
            foreach ($product_ratings as $rating) {
                $rating_array[] = $rating->getRating();
            }

            return array_sum($rating_array) / count($rating_array);
        })();

        $user_product_rating = intval(ProductRatingQuery::create()
            ->filterByUserId(Auth::getUser()->id())
            ->filterByProductId($product->getId())
            ->findOne()
            ?->getRating());

        $getInputHtml = function (int $rating) use ($product_rating, $user_product_rating, $product) {


            return (($user_product_rating === 0 ? $product_rating : $user_product_rating) === $rating ? 'checked' : '') . " class=\"rating-star\" type=\"radio\" 
            id=\"star-{$rating}_product_id{$product->getId()}\" name=\"rating_product_id{$product->getId()}\" value=\"{$rating}\" 
            data-product-id=\"{$product->getId()}\"";

        };
        ?>
        <div class="rating-area<?= $user_product_rating !== 0 ? ' user_rated' : ($product_rating === 0 ? ' not_enough_ratings' : '')
        ?>">
            <input <?= $getInputHtml(5) ?>>
            <label for="star-5_product_id<?= $product->getId() ?>" title="Оценка «5»"></label>
            <input <?= $getInputHtml(4) ?>>
            <label for="star-4_product_id<?= $product->getId() ?>" title="Оценка «4»"></label>
            <input <?= $getInputHtml(3) ?>>
            <label for="star-3_product_id<?= $product->getId() ?>" title="Оценка «3»"></label>
            <input <?= $getInputHtml(2) ?>>
            <label for="star-2_product_id<?= $product->getId() ?>" title="Оценка «2»"></label>
            <input <?= $getInputHtml(1) ?>>
            <label for="star-1_product_id<?= $product->getId() ?>" title="Оценка «1»"></label>
        </div>
        <div class="item_price_container">
            <?php if ($product->getDiscountPrice() === null) { ?>
                <strong class="price">РУБ <?= $product->getPrice() ?></strong>
                <?php
            } else { ?>
                <strong class="new_price"><?= doubleval($product->getDiscountPrice()) ?> РУБ</strong>
                <strong class="old_price"><?= doubleval($product->getPrice()) ?> РУБ</strong>
            <?php } ?>
        </div>
        <label>
            <?php if ($product->getProductSizess()->count() > 0) { ?>
                <select id="size_selector" name="item_size" class="item_size">
                    <?php
                    foreach ($product->getProductSizess() as $size) { ?>
                        <option value="<?= $size->getId() ?>"><?= strtoupper($size->getSize()) ?></option>
                    <?php } ?>
                </select>
            <?php } ?>
        </label>
        <!--  //* Id используется как стиль -->
        <button id="addToCard" class="button_add_product_to_cart" data-product-id="<?= $product->getId() ?>">
            Добавить в корзину
        </button>
        <?php if ($product->getDescription() !== null) { ?>
            <div class="item_info_container closed">
                <p>Описание</p><img src="/static/image/plus_ico.svg" alt="Развернуть">
                <div class="body_info">
                    <?= $product->getDescription() ?>
                </div>
            </div>
        <?php }

        if ($product->getCopmosition() !== null) { ?>
            <div class="item_info_container closed">
                <p>Состав</p><img src="/static/image/plus_ico.svg" alt="Развернуть">
                <div class="body_info"><?= $product->getCopmosition() ?></div>
            </div>
        <?php } ?>
        <div class="item_info_container closed">
            <p>Доставка</p><img src="/static/image/plus_ico.svg" alt="Развернуть">
            <div class="body_info">
                <h3>Отслеживаемая - ₽390</h3>
                <p>Доставка в течение 4-6 рабочих дней</p>
                <p>Доставка Пн - Пт</p>
                <p>Отслеживается только путь Почты России</p>
                <p>Получение в отделении Почты Росии или Почтамате</p>

                <br>
                <br>
                <br>

                <h3>Курьерская - ₽790</h3>
                <p>Доставка в течение 2-4 рабочих дней</p>
                <p>Доставка Пн - Пт</p>
                <p>Полностью отслеживаемый путь</p>
                <p>Доставка курьером по адресу через СДЭК</p>

            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<?php require __DIR__ . "/../site-content/footer/index.php" ?>
</body>

</html>