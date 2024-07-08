<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    @auth()
        <div>
            <a href="{{ route('userinfo', parameters: auth()->user()->getAttribute('name')) }}"><p>личный кабинет</p>
            </a>
            <a href="{{ route('logout') }}"><p>выход</p></a>
        </div>
    @elseguest()
        <a href="{{ route('login') }}"><p>вход</p></a>
        <a href="{{ route('register') }}"><p>регистрация</p></a>
    @endauth()
</div>
</body>
</html>

<header class="page-header">
    <div class="page-header__grid">
        <div class="page-header__logo">
            <a href="#">
                <img src="images/logo_investeri_withe.svg" alt="">
            </a>
        </div>
        <div class="page-header__nav">
            <nav class="nav-links page-header__nav-links">
                <a class="nav-link current" href="#">Главная</a>
                <a class="nav-link" href="#">Проекты</a>
                <a class="nav-link" href="#">Инвесторам</a>
                <a class="nav-link" href="#">Заемщикам</a>
                <a class="nav-link" href="#">FAQ</a>
            </nav>
        </div>
        @auth()
            <div class="page-header__auth">
                <a href="{{ route('userinfo', parameters: auth()->user()->getAttribute('name')) }}"
                   class="page-header__login page-header__auth-action">личный кабинет</a>
                <a href="{{ route('logout') }}" class="page-header__register page-header__auth-action">выход</a>
                @elseguest()
                    <a href="{{ route('login') }}" class="page-header__login page-header__auth-action">Вход</a>
                    <a href="{{ route('register') }}" class="page-header__register page-header__auth-action">Регистрация</a>
            </div>
        @endauth

        <button class="show-main-nav page-header__open-nav"></button>
    </div>
</header>
