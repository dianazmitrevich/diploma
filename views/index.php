<?php
   require 'chunk/header.php';
?>

                        <div class="themes-block themes content-block">
                            <div class="themes__wrapper container">
                                <div class="h2">Темы / теги</div>
                                <div class="themes__items">
                                    <?php foreach ($this->getMainTopics() as $key => $value) { ?>
                                    <div class="themes__item" data-element="1"><?php echo $value['name']; ?></div>
                                    <?php } ?>
                                </div>
                                <!-- <div class="themes__blocks">
                                    <div class="themes__block block themes__block-selected" data-element="1">
                                        <div class="block__row">
                                            <div class="block__col">
                                                <div class="block__col-title">Web3</div>
                                                <div class="block__col-text">Java (не путать с JavaScript) — строго
                                                    типизированный объектно-ориентированный язык программирования.
                                                    Приложения Java обычно транслируются в специальный байт-код, поэтому
                                                    они могут работать на любой компьютерной архитектуре, с помощью
                                                    виртуальной Java-машины (JVM). Используйте эту метку для вопросов,
                                                    относящихся к языку Java или инструментам из платформы Java.</div>
                                            </div>
                                            <div class="block__col block__col-right">
                                                <div class="wrap">
                                                    <div class="block__col-questions"><span>47,129</span> вопросов</div>
                                                    <div class="block__col-followers"><span>124</span> подписичков</div>
                                                </div><a class="block__col-cta">Задать вопрос</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="themes__block block" data-element="2">
                                        <div class="block__row">
                                            <div class="block__col">
                                                <div class="block__col-title">Web3</div>
                                                <div class="block__col-text">Java (не путать с JavaScript) — строго
                                                    типизированный объектно-ориентированный язык программирования.
                                                    Приложения Java обычно транслируются в специальный байт-код, поэтому
                                                    они могут работать на любой компьютерной архитектуре, с помощью
                                                    виртуальной Java-машины (JVM). Используйте эту метку для вопросов,
                                                    относящихся к языку Java или инструментам из платформы Java.</div>
                                            </div>
                                            <div class="block__col block__col-right">
                                                <div class="wrap">
                                                    <div class="block__col-questions"><span>47,129</span> вопросов</div>
                                                    <div class="block__col-followers"><span>124</span> подписичков</div>
                                                </div><a class="block__col-cta">Задать вопрос</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- <div class="companies-block companies content-block">
                            <div class="companies__wrapper container">
                                <div class="h2">Компании</div>
                                <div class="companies__items">
                                    <div class="companies__item companies-item item">
                                        <div class="item__row">
                                            <div class="item__col item__col-left">
                                                <div class="item__image"><img src="/resources/img/epam.png" alt=""></div>
                                                <div class="item__questions">22 вопроса</div>
                                                <div class="item__vacancies">1 вакансия</div>
                                            </div>
                                            <div class="item__col item__col-right">
                                                <div class="item__favourite favourite-btn favourite-btn-selected"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="companies__item companies-item item">
                                        <div class="item__row">
                                            <div class="item__col item__col-left">
                                                <div class="item__image"><img src="/resources/img/epam.png" alt=""></div>
                                                <div class="item__questions">22 вопроса</div>
                                                <div class="item__vacancies">1 вакансия</div>
                                            </div>
                                            <div class="item__col item__col-right">
                                                <div class="item__favourite favourite-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="questions-block questions content-block">
                            <div class="questions__wrapper container">
                                <div class="h2">Вопросы</div>
                                <div class="questions__items">
                                    <?php
                                        $data = $this->getQuestions();
                                        $count = count($data) > 5 ? 5 : count($data);
                                        for ($i=0; $i < $count; $i++) {
                                            $item = $data[$i];
                                    ?>
                                    <div class="questions__item questions-item item">
                                        <div class="item__row">
                                            <div class="item__col item__col-left">
                                                <div class="text-wrap">
                                                    <a href="/topics/<?php echo $item->main_topic_alias . '/' . $item->alias; ?>" class="item__title"><?php echo $item->name; ?></a>
                                                    <div class="item__tags">
                                                        <?php foreach ($item->tags as $inner_key => $inner_value) { ?>
                                                        <a class="item__tag"><?php echo $inner_value->name; ?></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="item__details">2 голоса&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                                                    ответа</div>
                                            </div>
                                            <div class="item__col item__col-right">
                                                <div class="text-wrap">
                                                    <div class="item__date"><?php echo $item->created_at; ?></div>
                                                    <div class="item__author">
                                                        <div class="img-cage">
                                                            <img src="/uploads/img/<?php echo $item->avatar; ?>" alt=""></div>
                                                        <p>@<?php echo $item->username; ?>, <span><?php echo $item->rating; ?> опыта</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="question__more">
                                        <p>Не нашли подходящий? Тогда используйте <span>перейдите в раздел</span> или
                                            создайте <span>свой вопрос</span></p>
                                        <a class="btn" href="/topics">Смотреть все вопросы</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="positions-block positions content-block">
                            <div class="positions__wrapper container">
                                <div class="h2">Вопросы на позицию</div>
                                <div class="positions__items">
                                    <div class="positions__item positions-item item">
                                        <div class="item__row">
                                            <div class="item__col item__col-left">
                                                <div class="item__title">Project Manager</div>
                                                <div class="item__questions">22 вопроса</div>
                                                <div class="item__vacancies">1 вакансия</div>
                                            </div>
                                            <div class="item__col item__col-right">
                                                <div class="item__favourite favourite-btn favourite-btn-selected"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="positions__item positions-item item">
                                        <div class="item__row">
                                            <div class="item__col item__col-left">
                                                <div class="item__title">Project Manager</div>
                                                <div class="item__questions">22 вопроса</div>
                                                <div class="item__vacancies">1 вакансия</div>
                                            </div>
                                            <div class="item__col item__col-right">
                                                <div class="item__favourite favourite-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

<?php
   require 'chunk/footer.php';
?>