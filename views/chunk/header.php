<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/resources/css/main.min.css">
    <script src="/resources/js/main.js"> </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="g-wrap global">
        <div class="outer-bg">
            <header class="header">
                <div class="header__wrapper">
                    <div class="header__row">
                        <div class="header__col">
                            <div class="header__links">
                                <a href="/progress">Прогресс</a>
                                <?php if ($this->getAuth()) { ?>
                                <a href="/my-questions">Мои вопросы</a>
                                <?php } else { ?>
                                    <a class="btn-ajax" data-url="/ajax/popup.php" data-id="435">Темы</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="header__col">
                            <?php if ($this->getAuth()) { ?>
                            <a class="header__btn btn btn-ajax" data-url="/ajax/popup.php" data-id="437" data-api="levels/topics/techs" data-user="<?php echo $this->getAuth(); ?>">Задать вопрос</a>
                            <a class="header__profile profile" href="/profile">
                                <div class="profile__name"><?php echo mb_strstr($this->getUser()['full_name'], ' ', true); ?></div>
                                <div class="profile__rating"><?php echo $this->getUser()['rating']; ?></div>
                                <div class="profile__image">
                                    <div class="image-wrap"><img src="<?php echo '/uploads/img/' . $this->getUser()['avatar']; ?>" alt=""></div>
                                </div>
                            </a>
                            <?php } else { ?>
                            <a class="btn btn-ajax" data-url="/ajax/popup.php" data-id="435">Войти</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </header>
            <main class="g-main">
                <aside class="aside">
                    <div class="aside__wrapper">
                        <div class="aside__row">
                            <div class="aside__col aside__col-upper">
                                <a class="aside__logo" href="/topics">
                                    <img src="/resources/img/logo.svg" alt=""></a>
                                <div class="aside__links">
                                    <a class="aside__link" href="/">
                                        <div class="link-img"><img src="/resources/img/aside-1.svg" alt=""></div>
                                        <p>Главная</p>
                                    </a>
                                    <?php if ($this->getAuth()) { ?>
                                        <a class="aside__link" href="/topics">
                                            <div class="link-img"><img src="/resources/img/aside-2.svg" alt=""></div>
                                            <p>Темы</p>
                                        </a>
                                        <!-- <a class="aside__link" href="/progress">
                                            <div class="link-img"><img src="/resources/img/aside-3.svg" alt=""></div>
                                            <p>Навигация</p>
                                        </a> -->
                                    <?php } ?>
                                    <!-- <a class="aside__link" href="/vacancies">
                                        <div class="link-img"><img src="/resources/img/aside-4.svg" alt=""></div>
                                        <p>Вакансии</p>
                                    </a> -->
                                </div>
                            </div>
                            <div class="aside__col aside__col-lower">
                                <div class="aside__links">
                                    <a class="aside__link">
                                        <p>Партнеры</p>
                                    </a>
                                    <a class="aside__link">
                                        <p>FAQ</p>
                                    </a>
                                    <a class="aside__link">
                                        <p>Настройки</p>
                                    </a>
                                    <?php if ($this->getAuth()) { ?>
                                    <a class="aside__link link-logout" href="/logout">
                                        <div class="link-img">
                                            <img src="/resources/img/aside-log-out.svg" alt="">
                                        </div>
                                        <p>Выйти</p>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <section class="content">
                    <div class="content__wrapper">