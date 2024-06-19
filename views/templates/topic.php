<title><?php echo 'Тема ' . $this->topic->getName() . ' – Hackora'; ?></title>
<?php
   require 'views/chunk/header.php';
?>
<div class="bonnet">
    <div class="bonnet__wrapper container">
        <div class="bonnet__line">Главная - Темы - <?php echo $this->topic->getName(); ?></div>
        <div class="bonnet__title h2"><?php echo $this->topic->getName(); ?></div>
    </div>
</div>
<?php if (!$this->topic->getQuestions()) { ?>
            <div class="empty-block empty">
                <div class="empty__wrapper container">
                  <div class="empty__row">
                    <div class="empty__col empty__col-image">
                      <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                    </div>
                    <div class="empty__col">
                      <div class="empty__title">Пусто!</div>
                      <div class="empty__subtitle">Пока еще никто не добавил вопрос к теме. Хотите задать свой вопрос? 😁</div>
                    </div>
                  </div>
                </div>
              </div>
<?php } else { ?>
<div class="questions-filter filter">
    <div class="filter__wrapper container">
        <div class="filter__tabs tabs">
            <div class="tabs__upper">
                <div class="tabs__item selected" data-detail="1">Технологии</div>
                <div class="tabs__item" data-detail="2">Уровень</div>
            </div>
            <div class="tabs__lower checkboxes-ajax checkboxes-collect" data-id="126" data-url="/ajax/api.php" data-element="126"
                data-api="questions" data-user="<?php echo $this->getUser()['id_user']; ?>" data-role="<?php echo $this->getUser()['role']; ?>" data-topic="<?php echo $this->topic->getId(); ?>">
                <div class="tabs__detail detail selected" data-detail="1">
                    <div class="detail__boxes">
                        <input type="hidden" name="filter_techs" data-info="1">
                        <?php foreach ($this->topic->getTechs() as $key => $value) {?>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="tech_<?php echo $value['id_tech']; ?>"
                                data-id="<?php echo $value['id_tech']; ?>">
                            <label for="tech_<?php echo $value['id_tech']; ?>"><?php echo $value['name']; ?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tabs__detail detail" data-detail="2">
                    <div class="detail__boxes">
                        <input type="hidden" name="filter_levels" data-info="2">
                        <?php foreach ($this->topic->getLevels() as $key => $value) {?> <div class="checkbox">
                            <input type="checkbox" name="" id="level_<?php echo $value['id_level']; ?>"
                                data-id="<?php echo $value['id_level']; ?>">
                            <label for="level_<?php echo $value['id_level']; ?>"><?php echo $value['name']; ?></label>
                        </div> <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter__text checkboxes-info">
            <p data-info="1">Выбранные технологии: -</p>
            <p data-info="2">Выбранные уровни: -</p>
        </div>
    </div>
</div>
<div class="questions-list list content-block">
    <div class="list__wrapper container">
        <div id="126">
            <?php foreach ($this->topic->getQuestions() as $key => $value) {?>
            <div class="list__item questions-item item">
                <div class="item__row">
                    <div class="item__col item__col-left">
                        <div class="text-wrap">
                            <div class="item__details"><?php echo count($this->question->getRepliesList($value['id_question'])); ?> ответа</div>
                            <a href="/topics/<?php echo $this->topic->getAlias() . '/' . $value['alias']; ?>"
                                class="item__title"><?php echo $value['name']; ?></a>
                            <div class="item__tags">
                                <?php foreach ($this->question->findAllTechnologies($value['id_question']) as $inner_key => $inner_value) {?>
                                <a lass="item__tag"><?php echo $this->technology->findById($inner_value['technology_id'])['name']; ?></a>
                                <?php } ?>
                                <a class="item__tag-level"><?php echo $this->level->findById($this->question->findById($value['id_question'])['level_id'])['name']; ?></a>
                                <?php if ($this->question->isValidated($value['id_question'])) {?><a class="item__tag-validated">Подтвержден</a><?php } ?>
                                <?php if ($this->user->findById($value['author_id'])['role'] === 'R') { ?><a class="item__tag-recruiter">Вопрос рекрутера</a><?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="item__col item__col-right">
                        <div class="text-wrap">
                            <div class="item__author">
                                <div class="img-cage">
                                    <img src="/uploads/img/<?php echo $this->user->findById($value['author_id'])['avatar']; ?>"
                                        alt="">
                                </div>
                                <?php if ($this->user->findById($value['author_id'])['role'] === 'R') { ?>
                                <p><?php echo $this->user->findById($value['author_id'])['username']; ?>
                                    <span class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->formatDate($value['created_at']); ?></span>
                                </p>
                                <?php } else { ?>
                                <p>@<?php echo $this->user->findById($value['author_id'])['username']; ?>,
                                    <span><?php echo $this->user->findById($value['author_id'])['rating']; ?> опыта</span>
                                    <span class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->formatDate($value['created_at']); ?></span>
                                </p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ($this->getAuth() && $this->getUser()['role'] !== 'A') { ?>
                        <div class="item__favourite favourite-btn checkbox-ajax" data-url="/edit-favourite">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <div class="checkbox checkbox-fav anim-btn">
                                <input <?php if ($this->question->isFavourite($value['id_question'], $this->getUser()['id_user'])) echo 'checked'; ?> type="checkbox"
                                    id="fav_<?php echo $value['id_question']; ?>" data-id="<?php echo $value['id_question']; ?>">
                                <label for="fav_<?php echo $value['id_question']; ?>"></label>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<?php
   require 'views/chunk/footer.php';
?>