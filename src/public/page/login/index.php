<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
</head>
<body>
<div class="grid_wrap_sign">
    <div class="main_wrap">
        <div class="image">
            <img src="/static/image/auth/login.jpg" alt="logo">
        </div>
        <div class="auth_form">
            <a href="/"><img src="/static/image/logo.svg" alt="logo"></a>
            <p class="h1"><b>АВТОРИЗАЦИЯ</b></p>
            <p id="error" style="color: red"> </p>
            <form>
                <input type="email" placeholder="Введите почту" class="text-inputs" autocomplete="email"
                       id="user_email" required>
                <input type="password" placeholder="Введите пароль" class="text-inputs"
                       autocomplete="current-password" id="user_password" required>
                <a href="#" class="link">Забыли пароль?</a>
                <input type="submit" value="Войти" id="auth_btn" formmethod="post">
                <p>Нет аккаунта? <a href="/register/" class="link">Зарегистрироваться</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>