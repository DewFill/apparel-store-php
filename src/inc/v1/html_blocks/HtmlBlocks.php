<?php

namespace inc\v1\html_blocks;

use DB\ProductRatingQuery;
use DB\Products;
use DB\UserFavoritesQuery;
use inc\v1\auth\Auth;

class HtmlBlocks
{
    private static bool $is_first_productCard_init = true;

    static function productCard(Products $product, $showAddToCartButton): string
    {

        if (self::$is_first_productCard_init) { ?>

            <link rel="stylesheet" href="/site-content/products/style.css">
            <script type="module" defer src="/site-content/products/rating_setter.js"></script>
            <script type="module" defer src="/site-content/products/favorite_setter.js"></script>
            <script type="module" defer src="/site-content/products/add_product_to_cart.js"></script>
            <?php
            self::$is_first_productCard_init = false;
        }

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

        $is_user_favorite = (function () use ($product) {
            $user = Auth::getUser();

            //если пользователь не авторизован, возвращаем false
            if (!$user->isLoggedIn()) return false;


            $is_favorite = UserFavoritesQuery::create()
                ->filterByProductId($product->getId())
                ->filterByUserId($user->getUserId())
                ->findOne();

            //если пользователь не добавил продукт в избранные, возвращаем false
            if ($is_favorite === null) return false;


            //если пользователь добавил продукт в избранные, возвращаем его оценку
            return true;
        })();

        $product_sizes = (function () use ($product) {
            $sizes = $product->getProductSizess();
            $sizes_array = [];

            foreach ($sizes as $size) {
                $sizes_array[] = ["id" => $size->getId(), "size_name" => strtoupper($size->getSize())];
            }

            return $sizes_array;
        })();

        $getInputHtml = function (int $rating) use ($product_rating, $user_product_rating, $product) {


            return (($user_product_rating === 0 ? $product_rating : $user_product_rating) === $rating ? 'checked' : '') . " class=\"rating-star\" type=\"radio\" 
            id=\"star-{$rating}_product_id{$product->getId()}\" name=\"rating_product_id{$product->getId()}\" value=\"{$rating}\" 
            data-product-id=\"{$product->getId()}\"";

        };
        ?>
        <div class="wrap_card"
             data-product-id="<?= $product->getId() ?>"
             data-product-sizes="<?= htmlspecialchars(json_encode($product_sizes)) ?>">
            <div class="bl_image">
                <a href="/product?product_id=<?= $product->getId() ?>&name=<?= $product->getName() ?>/"><img
                            src="/api/v1/product/main_image?product_id=<?=
                            $product->getId
                            () ?>/" alt="model_art"></a>
                <span class="<?= $is_user_favorite ? 'heart_active' : 'heart' ?>"></span>
            </div>
            <div class="bl_text">
                <?php
                if ($product->getBrands() === null) { ?>
                    <p class="brand"></p>
                <?php } else { ?>
                    <a class="brand" href="/brand?brand_id=<?= $product->getBrands()?->getId() ?>&name=<?=
                    $product->getBrands()?->getName() ?>/">
                        <?= $product->getBrands()?->getName() ?>
                    </a>
                <?php } ?>
                <a href="/product?product_id=<?= $product->getId() ?>&name=<?= $product->getName() ?>/">
                    <p class="name" style="cursor: pointer"><?= $product->getName() ?></p>
                </a>
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
                <p class="price">
                    <span class="red_price">
                        <?= $product->getDiscountPrice() === null
                            ? ""
                            : "₽ "
                              . doubleval($product->getDiscountPrice()) ?>
                    </span>
                    <span class="<?= $product->getDiscountPrice() === null ? "price" : "old_price" ?>">
                        <?= "₽ " . doubleval($product->getPrice()) ?>
                    </span>
                </p>
            </div>
            <?php
            if ($showAddToCartButton) { ?>
                <div class="bl_btn">
                    <button class="button_add_product_to_cart">Добавить в корзину</button>
                </div>
            <?php } ?>
        </div>
        <?php
        return "";
    }

    private static bool $is_first_textHeaderOne_init = true;

    public static function textHeaderOne($text, $color = "#ffcec3"): string
    {
        if (self::$is_first_textHeaderOne_init) { ?>
            <style>
                .main_style_heading {
                    width: 90% !important;
                    height: fit-content !important;
                    color: #FBFDFF !important;
                    margin: 30px auto !important;
                    text-align: center !important;
                    background-color: #3F484D !important;
                }

                @media (max-width: 768px) {
                    .main_style_heading {
                        margin: 0 auto;
                    }
                }
            </style>
        <?php }

        ?>
        <h1 class="main_style_heading" style="box-shadow: -15px 15px 0 -0px <?= $color ?>;"><?= $text ?></h1>
        <?php

        return "";
    }
}