<div class="grid">

    <!-- ================== main desktop menu =============== -->
    <div class="desktop_wrap">
        <div class="search">
            <label>
                <input type="text" placeholder="Поиск">
                <span class="icon_loop"></span>
                <span class="icon_cross "></span>
            </label>
        </div>
        <div class="logo">
            <img src="/static/image/logo.svg" alt="logo_type">
        </div>
        <div class="icons_menu">
            <a href="#">
                <span class="icon_link edited_link"></span>
            </a>
            <a href="#">
                <span class="icon_link bag_link"></span>
            </a>
            <a href="#">
                <span class="icon_link heart_link"></span>
            </a>
            <a href="#">
                <span class="icon_link account_link"></span>
            </a>
        </div>
        <div class="main_menu">
            <a href="#" class="menu_link" id="women_link">Женские</a>
            <a href="#" class="menu_link" id="men_link">Мужские</a>
            <a href="#" class="menu_link" id="brand_link">Бренды</a>
            <a href="#" class="menu_link" id="kids_link">Детские</a>
            <a href="#" class="menu_link" id="accessories_link">Аксессуары</a>
        </div>
    </div>

    <!-- ================= down  menu ============== -->
    <div class="wrap_down_menu">
        <div class="down_menu">
            <?php
            include_once("section_menu/index.php");
            ?>
            <div class="advertisement">
                <span class="ad_red">Распродажа</span>
                <span class="ad_red">Праздничная<br>коллекция</span>
                <span class="ad_red">Новинки</span>
            </div>
        </div>
    </div>


    <!-- ================= toggle menu ============== -->

    <div class="burger_wrap">
        <div class="logo">
            <img src="/static/image/logo.svg" alt="logo_type">
        </div>
        <div id="toggle_btn">
            <div class="container" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <span id="cross_btn none"></span>
            <span id="back_btn none"></span>
        </div>
        <div class="search">
            <label>
                <input type="text" placeholder="Поиск">
                <span class="icon_loop"></span>
                <span class="icon_cross "></span>
            </label>
        </div>
    </div>
</div>

<?php
include_once('sidebar/index.php');
?>
<script>
    function myFunction(x) {
        x.classList.toggle("change");
    }
</script>
<script src="script.js"></script>