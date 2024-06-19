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
                            <div class="header__dropdown dropdown">
                                <div class="dropdown__btn btn btn-yellow rect">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 3H3V10H10V3Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M21 3H14V10H21V3Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M21 14H14V21H21V14Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10 14H3V21H10V14Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div class="dropdown__wrap">
                                <div class="links">
                                    <?php if ($this->getAuth()) { ?>
                                    <a href="/progress">Прогресс</a>
                                    <a href="/my-questions">Мои вопросы</a>
                                    <?php } else { ?>
                                    <a href="/topics">Темы</a>
                                    <?php } ?>
                                </div>
                                <?php if ($this->getAuth()) { ?>
                                <a class="logout" href="/logout">
                                    <div class="link-img"><img src="/resources/img/aside-log-out.svg" alt=""></div>
                                    <p>Выйти</p>
                                </a>
                                <?php } ?>
                                </div>
                            </div>
                            <?php if ($this->getAuth()) { ?>
                            <div class="header__question">
                                <div class="btn rect btn-ajax" data-url="/ajax/popup.php" data-id="437" data-api="levels/topics/techs/topics-categorized" data-user="<?php echo $this->getAuth(); ?>">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 20H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="header__links">
                                <?php if ($this->getAuth() && $this->getUser()['role'] !== 'R' && $this->getUser()['role'] !== 'A') { ?>
                                <a href="/progress">Прогресс</a>
                                <?php } ?>
                                <?php if ($this->getAuth() && $this->getUser()['role'] !== 'A') { ?>
                                <a href="/my-questions">Мои вопросы</a>
                                <?php } else { ?>
                                <a href="/topics">Темы</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="header__col">
                            <?php if ($this->getAuth()) { ?>
                                <?php if ($this->getUser()['role'] !== 'A') { ?>
                            <a class="header__btn btn btn-ajax" data-url="/ajax/popup.php" data-id="437" data-api="levels/topics/techs/topics-categorized" data-user="<?php echo $this->getAuth(); ?>">Задать вопрос</a>
                                <?php } ?>
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
                                    <?php if ($this->getAuth() && $this->getUser()['role'] !== 'A') { ?>
                                        <a class="aside__link" href="/topics">
                                            <div class="link-img"><img src="/resources/img/aside-2.svg" alt=""></div>
                                            <p>Темы</p>
                                        </a>
                                        <!-- <a class="aside__link" href="/progress">
                                            <div class="link-img"><img src="/resources/img/aside-3.svg" alt=""></div>
                                            <p>Навигация</p>
                                        </a> -->
                                        <a class="aside__link" href="/favourites">
                                            <div class="link-img"><img src="/resources/img/aside-5.svg" alt=""></div>
                                            <p>Избранное</p>
                                        </a>
                                    <?php } ?>
                                    <a class="aside__link" href="/vacancies">
                                        <div class="link-img"><img src="/resources/img/aside-4.svg" alt=""></div>
                                        <p>Вакансии</p>
                                    </a>
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