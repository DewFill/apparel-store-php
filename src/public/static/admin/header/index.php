<?php

use Delight\Auth\Role;
use inc\v1\auth\Auth;

$isAdmin = Auth::getUser()->hasRole(Role::ADMIN); ?>
<link rel="stylesheet" href="/static/admin/header/style.css">
<script defer src="/static/admin/header/script.js"></script>

<header>
    <noscript style="display: block; width: 100%; height: max-content; background-color: yellow; position: fixed; z-index:
    9999">
        <p>JavaScript не поддерживается или отключен в Вашем браузере! Это может повлиять на работу сайта.
            <a href="https://www.enable-javascript.com/ru/" style="color: blue">Как включить JavaScript?</a></p>
    </noscript>
    <div class="top_instrumental">
        <form class="header_search" action="/search">
            <label style="display: none" for="header_search">Поиск:</label>
            <input type="search" name="q"
                   id="header_search"
                   placeholder="Искать по навзанию">
            <button type="submit">Search</button>
        </form>
        <a href='/' class="header_main_logo">
            <img src="/static/image/header/logo.svg">
        </a>
        <div class="header_icons_container"<?php if ($isAdmin) { ?>
            style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr"
        <?php } ?>>
            <a href='/edited/'><img src="/static/image/header/write_ico.svg" alt="Блог"></a>
            <a href='/cart/'><img src="/static/image/header/bag_ico.svg" alt="Корзина"></a>
            <a href='/favorites/'><img src="/static/image/header/heart_ico.svg" alt="Избранные"></a>
            <a href='/account/'><img src="/static/image/header/user_ico.svg" alt="Аккаунт"></a>
            <?php
            if ($isAdmin) { ?>
                <a href='/admin/'><img src="/static/image/header/admin.svg" alt="Управление"></a>
            <?php }
            ?>
        </div>
    </div>
    <nav class="header_navigator">
        <a href="/admin/orders/">Заказы</a>
        <a href="/admin/brands/">Бренды</a>
        <a href="/admin/products/">Товары</a>
        <a href="/admin/slides/">Слайдер</a>
        <a href="/admin/categories/">Категории</a>
        <a href="/admin/administrators/">Администраторы</a>
    </nav>
</header>