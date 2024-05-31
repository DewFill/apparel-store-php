<?php

use DB\SlidesQuery;

?>
<link rel="stylesheet" href="/static/slider/slider.css">
<script defer src="/static/slider/slider.js"></script>
<script defer src="/site-content/slider/script.js"></script>
<div class="slider" style="z-index: 1; max-height: 493px; width: 100%">
    <div class="slider__wrapper" style="z-index: 1;">
        <div class="slider__items" style="z-index: 1;">

            <?php
            $slides = SlidesQuery::create()->findByActive(true);
            foreach ($slides as $slide) {
                $url = $slide->getUrl() === null ? "" : "href='{$slide->getUrl()}'";
                ?>
                <a style="z-index: 2" class="slider__item" <?= ""//$url ?>>
                    <img style="width: 100%; height: 100%"
                         src="/api/v1/slide/image?slide_id=<?= $slide->getId() ?>/" alt="slider image"/>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
    <a href="#" class="slider__control" data-slide="prev" style="z-index: 5"></a>
    <a href="#" class="slider__control" data-slide="next" style="z-index: 5"></a>
    <ol class="slider__indicators">
        <?php
        for ($i = 0; $i < $slides->count(); $i++) {
            ?>
            <li data-slide-to="<?= $i ?>"></li>
            <?php
        }
        ?>
    </ol>
</div>