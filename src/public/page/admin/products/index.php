<?php

use DB\BrandsQuery;
use DB\CategoriesQuery;
use DB\ProductsQuery;
use inc\v1\html_blocks\HtmlBlocks;
use Propel\Runtime\Exception\PropelException;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактировать товары</title>
    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/site-content/products/style.css">
    <script defer src="product_adder.js"></script>
    <script defer src="size_adder.js"></script>
    <script defer src="categories_adder.js"></script>
    <script type="module" defer src="product_deleter.js"></script>
    <script type="module" defer src="product_editer.js"></script>


</head>
<body>
<?php require __DIR__ . "/../../../static/admin/header/index.php" ?>

<main style="margin-bottom: 150px">
    <div style="max-width: 90%">
        <?= HtmlBlocks::textHeaderOne("Добавление товара", "#6565af") ?>
        <div class="product_add_wrapper">
            <div class="product_add_container">
                <form enctype="multipart/form-data" class="add_form product_form" action="">
                    <label>
                        Название товара <span>*</span>
                        <input type="text" name="product_name" required>
                    </label>

                    <label>
                        Цена без скидки <span>*</span>
                        <input type="number" name="product_price" min=".01" step=".01" required>
                    </label>
                    <label>
                        Главное фото <span>*</span>
                        <input type="file" name="product_main_image">
                    </label>
                    <p id="error" style="color: red"></p>
                    <br>


                    <label>
                        Цена со скидкой
                        <input type="number" name="product_discount_price" min=".01" step=".01">
                    </label>
                    <label for="size_add_select">Размеры</label>
                    <div style="display: flex; flex-flow: row; gap: 5px">
                        <select name="" id="size_add_select" class="size_add_select">
                            <option value="xs">XS</option>
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="xxl">XXL</option>
                            <option value="3xl">3XL</option>
                        </select>
                        <button class="size_add_button" type="button">Добавить</button>
                    </div>
                    <label>
                        Бренд
                        <select name="product_brand_id" id="brand_select">
                            <option value="0"></option>
                            <?php
                            $brands = BrandsQuery::create()->find();
                            foreach ($brands as $brand) { ?>
                                <option value="<?= $brand->getId() ?>"><?= $brand->getName() ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label>
                        Описание
                        <textarea name="product_description"></textarea>
                    </label>
                    <label>
                        Состав
                        <textarea type="text" name="product_composition"></textarea>
                    </label>
                    <label for="categories_add_select">Категории</label>
                    <div style="display: flex; flex-flow: row; gap: 5px">
                        <select name="" id="categories_add_select" class="categories_add_select">
                            <?php
                            $categories = CategoriesQuery::create()->find();
                            foreach ($categories as $category) { ?>
                                <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                            <?php } ?>
                        </select>
                        <button class="categories_add_button" type="button">Добавить</button>
                    </div>
                    <label>
                        Артикул
                        <input type="text" name="product_article">
                    </label>
                    <label>
                        Дополнительные фото
                        <input type="file" name="other_images[]" multiple="multiple">
                    </label>

                    <input class="create_product_button" type="submit" value="Добавить товар">
                </form>
                <p>Ссылка на товар: <a style="color: blue" class="product_link" href=""></a></p>
            </div>


            <div class="grid_wrap">
                <div class="flex_wrap">
                    <div class="wrap_card" data-product-id="15" style="overflow: hidden">
                        <div class="bl_image">
                            <img src="/static/image/icon_product/product-example.jpg" alt="model_art">
                            <span class="heart"></span>
                        </div>
                        <div class="bl_text">
                            <a class="brand" href=""></a>
                            <p class="name" style="cursor: pointer">НАЗВАНИЕ ТОВАРА</p>
                            <div class="rating-area">
                                <input class="rating-star" type="radio" id="star-5_product_id15"
                                       name="rating_product_id15" value="5" data-product-id="15" checked>
                                <label for="star-5_product_id15" title="Оценка «5»"></label>
                                <input class="rating-star" type="radio" id="star-4_product_id15"
                                       name="rating_product_id15" value="4" data-product-id="15">
                                <label for="star-4_product_id15" title="Оценка «4»"></label>
                                <input class="rating-star" type="radio" id="star-3_product_id15"
                                       name="rating_product_id15" value="3" data-product-id="15">
                                <label for="star-3_product_id15" title="Оценка «3»"></label>
                                <input class="rating-star" type="radio" id="star-2_product_id15"
                                       name="rating_product_id15" value="2" data-product-id="15">
                                <label for="star-2_product_id15" title="Оценка «2»"></label>
                                <input class="rating-star" type="radio" id="star-1_product_id15"
                                       name="rating_product_id15" value="1" data-product-id="15">
                                <label for="star-1_product_id15" title="Оценка «1»"></label>
                            </div>
                            <p class="price">
                                <span class="red_price" style="display: none">₽ 0</span>
                                <span class="old_price" style="margin-left: 0; text-decoration: none">₽ 0</span>
                            </p>
                        </div>
                        <div class="bl_btn">
                            <button class="button_add_product_to_cart"
                                    style="border-color: #B2ABB2 !important; color: gray">
                                Добавить в корзину
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>

        <?= HtmlBlocks::textHeaderOne("Удаление товара", "#6565af") ?>
        <div style="display: flex; flex-flow: column; align-items: center; width: 100%">
            <label for="delete_product_select"></label>
            <select name="delete_product" id="delete_product_select" style="width: 80%; max-width: 800px">
                <?php
                $products = ProductsQuery::create()->find();
                foreach ($products as $product) { ?>
                    <option value="<?= $product->getId() ?>">
                        <?= "ID: {$product->getId()}
                             | {$product->getName()}" ?>
                        <?php
                        try {
                            $brand_name = $product->getBrands()?->getName();
                            if ($brand_name !== null) {
                                echo "| {$brand_name}";
                            }
                        } catch (PropelException $e) {
                        } ?>
                        <?= "| ₽ " . $product->getDiscountPrice() === null
                            ? $product->getPrice()
                            :
                            $product->getDiscountPrice() ?>
                    </option>
                <?php } ?>
            </select>
            <button class="delete_product_button"
                    style="margin-top:10px; border-color: red; width: 80%; max-width: 800px">
                Удалить товар
            </button>
        </div>
</main>
</body>
</html>