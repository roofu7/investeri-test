<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <script type="module" crossorigin src="assets/main-atmk15eg.js"></script>
    @vite('resources/css/app.scss')
</head>

<body>
<header class="page-header">
    <div class="page-header__grid">
        <div class="page-header__logo">
            @if( request()->path() == '/' )
                <img src="images/logo_investeri_withe.svg" alt="">
            @else
                <a href="{{ route('home') }}">
                    <img src="images/logo_investeri_withe.svg" alt="">
                </a>
            @endif
        </div>
        <div class="page-header__nav">
            <nav class="nav-links page-header__nav-links">
                @foreach ( $page as $pages )
                    @if( request()->path() == $pages->slug)
                        <a class="nav-link current" href="{{ $pages->slug }}">{{ $pages->title }}</a>
                    @else
                        <a class="nav-link" href="{{ $pages->slug }}">{{ $pages->title }}</a>
                    @endif
                @endforeach
            </nav>
        </div>

        <div class="page-header__auth">
            @auth()
                <a href="{{ route('userinfo', parameters: auth()->user()->getAttribute('name')) }}"
                   class="page-header__login page-header__auth-action">личный кабинет</a>
                <a href="{{ route('logout') }}" class="page-header__register page-header__auth-action">выход</a>
            @elseguest()
                <a href="{{ route('login') }}" class="page-header__login page-header__auth-action">Вход</a>
                <a href="{{ route('register') }}" class="page-header__register page-header__auth-action">Регистрация</a>
            @endauth
        </div>

        <button class="show-main-nav page-header__open-nav"></button>
    </div>
</header>
<h1>Я сделал новые правки</h1>
<div class="page-main index-main">

    <div class="intro-banner">
        <div class="intro-banner__inner">
            <div class="intro-banner__bg"></div>
            <div class="intro-banner__content">
                <div class="intro-banner__title">
                    Заголовок первого<br> уровня. Одна-две строки
                </div>
                <div class="intro-banner__desc">
                    Позвольте нам взять под своё крыло финансирование вашего предприятия, чтобы вы могли свободно
                    заниматься расширением и достижением новых пиков успешности.
                </div>
                <a class="ind-link ind-link_theme_accent-btn intro-banner__action" href="{{ route('register') }}">Регистрация</a>
            </div>
        </div>
    </div>

    <section class="base-section intro-description-section">
        <div class="container">
            <div class="base-section__head">
                <h2 class="section-title section-title_centered">
                    Заголовок второго уровня. Одна-две строки
                </h2>
            </div>
            <div class="gen-block gen-block_on-plate gen-block_text-centered base-section__body">
                Позвольте нам взять под своё крыло финансирование вашего предприятия, чтобы вы могли свободно заниматься
                расширением и достижением новых пиков успешности.
            </div>
        </div>
    </section>

    <div class="projects-review-section">
        <div class="base-section__body projects-review-section__body container">
            <a href="#" class="ind-link ind-link_theme_next projects-review-section__more-link">Посмотреть все кейсы</a>

            <div class="project-card-list project-card-list_grid_base projects-review-section__project-card-items">

                @foreach( $company as $companies )
                    @if( $loop->index == 3 )
                        @break
                    @endif
                    <article class="project-card project-card_theme_normal project-cards-section__project-card-item">
                        <div class="project-card__fig">
                            <a class="project-card__card-link" href="#"></a>
                            <img class="project-card__fig-img" src="assets/banner1-DQxjRDzc.jpg" alt="">
                            <div class="person-avatar person-avatar_theme_circle project-card__label">
                                <img src="assets/banner2-BC5FGtnE.jpg" alt="">
                            </div>
                            <div class="project-card__badge">Елена</div>
                        </div>
                        <div class="project-card__main">
                            <div class="project-card__title">
                                <a href="#">{{ $companies->name }}</a>
                            </div>
                            <div class="project-card__desc">выгодные под 10 процентов</div>
                            <div class="project-card__location">МСК</div>
                            <div class="project-card__goal-info">
                                {{--<div class="project-card__goal-info-labels">
                                    <div class="project-card__goal-info-label project-card__goal-info-label_min">мин.
                                        цель:<br>1000р.
                                    </div>
                                    <div class="project-card__goal-info-label project-card__goal-info-label_max">макс.
                                        цель:<br>10000р.
                                    </div>
                                </div>
                                <div class="project-card__goal-info-progress progress-block progress-block_theme_l">
                                    <div class="progress-block__level" style="width: 30%"></div>
                                    <div class="progress-block__number-value">30%</div>
                                </div>--}}
                                <div class="project-card__goal-info-remains">
                                    осталось дней 150
                                </div>
                            </div>
                        </div>
                        <a href="#" class="project-card__action">инвестировать сейчас</a>
                    </article>
                @endforeach

            </div>

        </div>
    </div>

    <section class="base-section base-promises-section" style="--animation-duration: 1.1s;">
        <div class="base-section__head container">
            <h2 class="section-title section-title_centered workflow-section__title">
                Заголовок второго уровня. Одна-две строки
            </h2>
        </div>
        <div class="base-section__body base-promises-section__inner">
            <div class="base-promises-section__items container">
                <div class="gen-block gen-block_on-plate base-promises-section__item base-promises-section__first-item">
                    Получите инструменты и практические советы, необходимые для получения средств. Мы поможем вам
                    закрыть финансирование и перейти к перспективам развития вашего бизнеса.
                </div>
                <div class="gen-block gen-block_on-plate base-promises-section__item base-promises-section__last-item">
                    Оперативно рассмотрим вашу заявку. Более 700 крупных инвесторов ждут вашего проекта.
                </div>
            </div>
        </div>
    </section>

    <div class="base-section suggested-projects-section">
        <div class="base-section__head suggested-projects-section__head container">
            <h2 class="section-title section-title_centered suggested-projects-section__title">
                Рекомендуемые компании
            </h2>
        </div>
        <div class="base-section__body suggested-projects-section__body container">
            <div class="project-card-list project-card-list_grid_base suggested-projects-section__project-card-items">

                @foreach( $company as $companies )
                    @if( $loop->index == 3 )
                        @break
                    @endif
                    <article class="project-card project-card_theme_normal project-cards-section__project-card-item">
                        <div class="project-card__fig">
                            <a class="project-card__card-link" href="#"></a>
                            <img class="project-card__fig-img" src="assets/banner1-DQxjRDzc.jpg" alt="">
                            <div class="person-avatar person-avatar_theme_circle project-card__label">
                                <img src="assets/banner2-BC5FGtnE.jpg" alt="">
                            </div>
                            <div class="project-card__badge">Елена</div>
                        </div>
                        <div class="project-card__main">
                            <div class="project-card__title">
                                <a href="#">{{ $companies->name }}</a>
                            </div>
                            <div class="project-card__desc">выгодные под 10 процентов</div>
                            <div class="project-card__location">МСК</div>
                            <div class="project-card__goal-info">
                                <div class="project-card__goal-info-labels">
                                    <div class="project-card__goal-info-label project-card__goal-info-label_min">мин.
                                        цель:<br>1000р.
                                    </div>
                                    <div class="project-card__goal-info-label project-card__goal-info-label_max">макс.
                                        цель:<br>10000р.
                                    </div>
                                </div>
                                <div class="project-card__goal-info-progress progress-block progress-block_theme_l">
                                    <div class="progress-block__level" style="width: 30%"></div>
                                    <div class="progress-block__number-value">30%</div>
                                </div>
                                <div class="project-card__goal-info-remains">
                                    осталось дней 150
                                </div>
                            </div>
                        </div>
                        <a href="#" class="project-card__action">инвестировать сейчас</a>
                    </article>
                @endforeach


            </div>
        </div>
    </div>

    <section class="base-section workflow-section">
        <div class="base-section__head workflow-section__head container">
            <h2 class="section-title section-title_centered workflow-section__title">
                Как это работает
            </h2>
        </div>
        <div class="base-section__body workflow-section__body container">
            <ol class="workflow-section__steps">
                <li class="workflow-section__step workflow-section__step_1">
                    Зарегистрируйтесь
                </li>
                <li class="workflow-section__step workflow-section__step_2">
                    Загрузите документы,пройдите верификацию и предоставьте свой бизнес-план.
                </li>
                <li class="workflow-section__step workflow-section__step_3">
                    Быстро получите финансирование
                </li>
            </ol>
        </div>
    </section>

    <div class="reviews-section">
        <div class="reviews-section__slider-block">
            <div class="container">
                <div class="swiper reviews-section__slider reviews-slider reviews-slider_theme_base">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        <div class="swiper-slide review-card">
                            <div class="review-card__head">
                                <div class="person-avatar person-avatar_theme_circle review-card__avatar">
                                    <img src="assets/girll-DgawVtv6.jpg" alt="">
                                </div>
                                <div class="review-card__name">Дмитрий</div>
                            </div>
                            <div class="review-card__body">
                                <div class="review-card__user-review-block">
                                    <!--                                    <div class="review-card__quote">"</div>-->
                                    <div class="review-card__user-review">
                                        Получайте деньги не выходя из дома, в любое время в режиме онлайн. Для получения
                                        Вам не нужно ехать к нам в офис, нужен только интернет.
                                    </div>
                                    <!--                                    <div class="review-card__quote">"</div>-->
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide review-card">
                            <div class="review-card__head">
                                <div class="person-avatar person-avatar_theme_circle review-card__avatar">
                                    <img src="assets/girll-DgawVtv6.jpg" alt="">
                                </div>
                                <div class="review-card__name">Дмитрий</div>
                            </div>
                            <div class="review-card__body">
                                <div class="review-card__user-review-block">
                                    <!--                                    <div class="review-card__quote">"</div>-->
                                    <div class="review-card__user-review">
                                        Получайте деньги не выходя из дома, в любое время в режиме онлайн. Для получения
                                        Вам не нужно ехать к нам в офис, нужен только интернет.
                                    </div>
                                    <!--                                    <div class="review-card__quote">"</div>-->
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide review-card">
                            <div class="review-card__head">
                                <div class="person-avatar person-avatar_theme_circle review-card__avatar">
                                    <img src="assets/girll-DgawVtv6.jpg" alt="">
                                </div>
                                <div class="review-card__name">Дмитрий</div>
                            </div>
                            <div class="review-card__body">
                                <div class="review-card__user-review-block">
                                    <!--                                    <div class="review-card__quote">"</div>-->
                                    <div class="review-card__user-review">
                                        Получайте деньги не выходя из дома, в любое время в режиме онлайн. Для получения
                                        Вам не нужно ехать к нам в офис, нужен только интернет.
                                    </div>
                                    <!--                                    <div class="review-card__quote">"</div>-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div
                class="swiper-button-prev slider-nav-btn slider-nav-btn_prev slider-nav-btn_theme_base reviews-section__slider-nav reviews-section__slider-nav_prev"></div>
            <div
                class="swiper-button-next slider-nav-btn slider-nav-btn_next slider-nav-btn_theme_base reviews-section__slider-nav reviews-section__slider-nav_next"></div>
        </div>
    </div>


</div>
<footer class="page-footer">
    <div class="page-footer__main">
        <!--        <div class="page-footer__logo">-->
        <!--            <img src="uploads/settings/logo.svg" alt="">-->
        <!--        </div>-->
        <div class="page-footer__nav">
            <nav class="nav-links page-footer__nav-links">
                <a class="nav-link current" href="#">Главная</a>
                <a class="nav-link" href="#">Проекты</a>
                <a class="nav-link" href="#">Инвесторам</a>
                <a class="nav-link" href="#">Заемщикам</a>
                <a class="nav-link" href="#">FAQ</a>
            </nav>
        </div>
    </div>
    <div class="page-footer__bottom">
        <div class="page-footer__doc-links">
            <a class="page-footer__doc-link" href="#" target="_blank">Раскрытие информации</a>
            <a class="page-footer__doc-link" href="#" target="_blank">Документы платформы</a>
        </div>
        <div class="page-footer__copyright">
            ©2023-2024
        </div>
    </div>
</footer>


<div hidden id="nav-panel" class="main-nav">
    <div class="main-nav__header">
        <div class="main-nav__logo">
            @if( request()->path() == route('home') )
                <a href="{{ route('home') }}">
                    <img src="images/logo_investeri_withe.svg" alt="">
                </a>
            @else
                <img src="images/logo_investeri_withe.svg" alt="">
            @endif
        </div>
    </div>
    <div class="main-nav__main">
        <nav class="nav-links main-nav__nav-links">
            @foreach ( $page as $pages )
                @if( request()->path() == $pages->slug)
                    <a class="nav-link current" href="{{ $pages->slug }}">{{ $pages->title }}</a>
                @else
                    <a class="nav-link" href="{{ $pages->slug }}">{{ $pages->title }}</a>
                @endif
            @endforeach
        </nav>
    </div>
    <div class="main-nav__footer">
        <div class="main-nav__auth">
            @auth()
                <a href="{{ route('userinfo', parameters: auth()->user()->getAttribute('name')) }}"
                   class="page-header__login page-header__auth-action">личный кабинет</a>
                <a href="{{ route('logout') }}" class="page-header__register page-header__auth-action">выход</a>
            @elseguest()
                <a href="{{ route('login') }}" class="page-header__login page-header__auth-action">Вход</a>
                <a href="{{ route('register') }}" class="page-header__register page-header__auth-action">Регистрация</a>
            @endauth
        </div>
    </div>
</div>
@vite('resources/js/app.js')
<!--<script type="module" src="resources/js/app.js"></script>-->
</body>
</html>
