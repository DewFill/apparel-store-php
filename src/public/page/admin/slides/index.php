<?php

use DB\SlidesQuery;
use inc\v1\html_blocks\HtmlBlocks;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование сайтов</title>
    <script defer
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/static/slider/slider.css">
    <script defer src="/static/slider/slider.js"></script>
    <script defer src="slider_configuration.js"></script>
</head>
<body>
<?php require __DIR__ . "/../../../static/admin/header/index.php" ?>
<main>
    <div>

        <?= HtmlBlocks::textHeaderOne("Добавить слайд", "#6565af") ?>
        <form id="form_create">
            <p>Рекомендуемое соотношение сторон изображения: 134∶35</p>
            <input type="file" name="slide_image"/>
            <input type="submit" class="button" value="Загрузить"/>
            <p id="error" style="color: red"></p>
            <div class="error"></div>
        </form>

        <!--    SLIDER EXAMPLE START-->
        <div id="add_slider" class="slider"
             style="z-index: 1; max-height: 493px; width: 1px; overflow: hidden">
            <div class="slider__wrapper" style="z-index: 1;">
                <div class="slider__items" style="z-index: 1;">

                    <?php
                    $slides = SlidesQuery::create()->findByActive(true);
                    foreach ($slides as $slide) {
                        $url = $slide->getUrl() === null ? "" : "href='{$slide->getUrl()}'";
                        ?>
                        <a style="z-index: 2" class="slider__item" <?= ""//$url  ?>>
                            <img style="width: 100%; height: 100%"
                                 src="/api/v1/slide/image?slide_id=<?= $slide->getId() ?>/" alt="slider image"/>
                        </a>
                        <?php
                    }
                    ?>

                    <a style="z-index: 2" class="slider__item">
                        <img id="slide_image" style="width: 100%; height: 100%"
                             src="#" alt="slider image"/>
                    </a>
                </div>
            </div>
            <a href="#" class="slider__control" data-slide="prev" style="z-index: 5"></a>
            <a href="#" class="slider__control" data-slide="next" style="z-index: 5"></a>
            <ol class="slider__indicators">
                <?php
                for ($i = 0; $i < $slides->count() + 1; $i++) {
                    ?>
                    <li data-slide-to="<?= $i ?>"></li>
                    <?php
                }
                ?>
            </ol>
        </div>
        <!--    SLIDER EXAMPLE END-->
        <br>
        <br>
        <br>


        <?= HtmlBlocks::textHeaderOne("Удалить слайд", "#6565af") ?>

        <form id="form_delete">
            <label>
                <select>
                    <?php
                    $slides = SlidesQuery::create()->find();
                    foreach ($slides as $slide) {
                        $id = $slide->getId();
                        echo "<option value='$id'>ID: $id</option>";
                    }
                    ?>
                </select>
            </label>
            <input type="submit" class="button" value="Удалить" id="but_delete">
            <div class="error"></div>
        </form>
        <br>
        <br>
        <br>


        <?= HtmlBlocks::textHeaderOne("Изменить слайд", "#6565af") ?>

        <form id="form_update">
            <label>
                <select>
                    <?php
                    $slides = SlidesQuery::create()->find();
                    foreach ($slides as $slide) {
                        $id = $slide->getId();
                        echo "<option value='$id'>ID: $id</option>";
                    }
                    ?>
                </select>
            </label>
            <input type="file" name="slide_image"/>
            <input type="submit" class="button" value="Загрузить">
            <div class="error"></div>
        </form>
    </div>
</main>
<br>
<br>
<br>
</body>
</html>