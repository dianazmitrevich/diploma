                    </div>
                </section>
                <footer class="footer">
                    <div class="footer__wrapper">
                        <div class="col-wrap">
                            <div class="footer__col">
                                <a class="link" href="/">Главная</a>
                                <a class="link" href="/vacancies">Вакансии</a>
                                <a class="link" href="/topics">Темы</a>
                            </div>
                            <?php if ($this->getAuth()) { ?>
                            <div class="footer__col">
                                <a class="link" href="/favourites">Избранное</a>
                                <a class="link" href="/my-questions">Мои вопросы</a>
                                <a class="link" href="/progress">Прогресс</a>
                                <a class="link btn-ajax" data-url="/ajax/popup.php" data-id="437" data-api="levels/topics/techs/topics-categorized" data-user="<?php echo $this->getAuth(); ?>">Добавить вопрос</a>
                                <a class="link btn-ajax" data-url="/ajax/popup.php" data-id="438" data-api="main_topics" data-user="<?php echo $this->getAuth(); ?>">Добавить тему</a>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="footer__credentials">
                            <div class="footer__logo"><img src="/resources/img/logo.svg" alt=""></div>
                            <p>Дизайн сайта / логотип © 2024 dianazmitrevich</p>
                        </div>
                    </div>
                </footer>
                <div class="popups">
                </div>
                <div class="confirm">
                    <div class="confirm__wrapper">
                    <div class="confirm-wrap"></div>
                    <div class="confirm__wrap">
                        <div class="wrap">
                        <div class="wrap__title">⚠️ Уведомление</div>
                        <div class="wrap__text"></div>
                        <div class="wrap__btns">
                            <div class="btn btn-yellow"></div>
                            <div class="btn btn-grey">Отмена</div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>