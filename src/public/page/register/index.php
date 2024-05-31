<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/login/style.css">
</head>
<body>
<div class="grid_wrap_sign">
    <div class="main_wrap">
        <div class="image">
            <img src="/static/image/auth/register.jpg" alt="logo">
        </div>
        <div class="auth_form">
            <a href="/"><img src="/static/image/logo.svg" alt="logo"></a>
            <p class="h1"><b>РЕГИСТРАЦИЯ</b></p>
            <p id="error" style="color: red"> </p>
            <form>
                <input class="text-inputs" type="email" placeholder="Введите почту" autocomplete="email" id="user_email" required>
                <input class="text-inputs" type="text" placeholder="Введите никнейм" autocomplete="name" id="user_username" required>
                <input class="text-inputs" type="password" placeholder="Введите пароль" autocomplete="" id="user_password" required>
                <input type="submit" value="Зарегистрироваться" id="auth_btn" formmethod="post">
                <p>Уже есть аккаунта? <a href="/login/" class="link">Войти</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>