<?php
use Delight\Auth\Role;
use inc\v1\auth\Auth;
$isAdmin = Auth::getUser()->hasRole(Role::ADMIN); ?>
<link rel="stylesheet" href="/site-content/header/style.css">
<script defer src="/site-content/header/script.js"></script>

<header>
    <noscript style="display: block; width: 100%; height: max-content; background-color: #f5e424; position: fixed; z-index:
    9999">
        <p style="text-align: center">JavaScript не поддерживается или отключен в Вашем браузере! Это может повлиять на
            работу сайта.
            <a href="https://www.enable-javascript.com/ru/" style="color: blue">Как включить JavaScript?</a></p>
    </noscript>
    <div class="top_instrumental">
        <form class="header_search" action="/search">
            <label style="display: none" for="header_search">Поиск:</label>
            <input type="search" name="q"
                   id="header_search"
                   placeholder="Искать по названию...">
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
        <a href="/category?category_id=1&name=woman/">Женское</a>
        <a href="/category?category_id=2&name=man/">Мужское</a>
        <a href="/brands/">Бренды</a>
        <a href="/category?category_id=3&name=children/">Детское</a>
        <a href="/category?category_id=4&name=accessories/">Аксессуары</a>
    </nav>
</header>