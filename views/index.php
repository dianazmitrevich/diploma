<?php
   require 'chunk/index/header.php';
?>

<div class="g-wrap global index-page">
        <div class="outer-bg">
            <header class="header">
                <div class="header__wrapper container">
                    <div class="header__row">
                        <div class="header__col">
                            <div class="header__col-logo"><img src="/resources/img/logo.svg" alt=""></div>
                            <nav class="header__col-nav">
                                <a href="/topics">Темы</a>
                                <a href="/progress">Мой прогресс</a>
                                <a href="">Навигация</a>
                                <a href="/vacancies">Вакансии</a></nav>
                        </div>
                        <div class="header__col"><a href="/profile" class="btn btn-grey">Войти</a></div>
                    </div>
                </div>
            </header>
            <main class="g-main">
                <section class="index-banner banner content-block">
                    <div class="banner__wrapper container">
                        <div class="banner-wrap"><img src="/resources/img/index-banner.png" alt=""></div>
                        <div class="banner__wrap">
                            <div class="banner__title">Подготовка к собеседованиям в IT с полным погружением</div>
                            <a href="/topics" class="btn">Перейти к темам</a>
                            <div class="banner__items">
                                <div class="banner__item"><img src="/resources/img/banner-icon-1.svg" alt="">
                                    <p>Получайте быструю обратную связь</p>
                                </div>
                                <div class="banner__item"><img src="/resources/img/banner-icon-2.svg" alt="">
                                    <p>Отслеживайте свой прогресс</p>
                                </div>
                                <div class="banner__item"><img src="/resources/img/banner-icon-3.svg" alt="">
                                    <p>Занимайтесь подготовкой в любое удобное время</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="index-profile profile content-block">
                    <div class="profile__wrapper container">
                        <div class="profile__row">
                            <div class="profile__col">
                                <div class="profile__title">Ваш личный кабинет для подготовки</div>
                                <div class="profile__text">Они прошли специальное внутреннее обучение, сдали экзамен
                                    и готовы справиться с чем угодно. Понятно объяснят любую тему: от глагола
                                    to be до косвенной речиПомогут решить практические задачи: например, подготовят
                                    к собеседованию</div>
                            </div>
                            <div class="profile__col profile__col-right"><a href="/profile" class="btn">Перейти</a><img
                                    src="/resources/img/index-profile.png" alt=""></div>
                        </div>
                    </div>
                </section>

<?php
   require 'chunk/index/footer.php';
?>