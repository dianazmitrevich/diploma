<?php
   require 'views/chunk/header.php';
?> <div class="bonnet">
    <div class="bonnet__wrapper container">
        <div class="bonnet__line">Главная - Темы - <?php echo $this->topic->getName(); ?></div>
        <div class="bonnet__title h2"><?php echo $this->topic->getName(); ?></div>
    </div>
</div>
<div class="questions-filter filter">
    <div class="filter__wrapper container">
        <div class="filter__tabs tabs">
            <div class="tabs__upper">
                <div class="tabs__item selected" data-detail="1">Технологии</div>
                <div class="tabs__item" data-detail="2">Уровень</div>
                <!-- <div class="tabs__item" data-detail="3">Компании</div> -->
            </div>
            <div class="tabs__lower checkboxes-ajax checkboxes-collect" data-id="126" data-url="/ajax/api.php" data-element="126"
                data-api="questions">
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
                <!-- <div class="tabs__detail detail" data-detail="3">
                                            <div class="detail__boxes">
                                                <div class="checkbox"><input type="checkbox" name="" id="c_6"><label
                                                        for="c_6">EPAM Systems</label></div>
                                                <div class="checkbox"><input type="checkbox" name="" id="c_7"><label
                                                        for="c_7">Modsen</label></div>
                                                <div class="checkbox"><input type="checkbox" name="" id="c_8"><label
                                                        for="c_8">LeverX</label></div>
                                                <div class="checkbox"><input type="checkbox" name="" id="c_9"><label
                                                        for="c_9">IBA GROUP</label></div>
                                                <div class="checkbox"><input type="checkbox" name="" id="c_10"><label
                                                        for="c_10">Melsoft</label></div>
                                            </div>
                                        </div> -->
            </div>
        </div>
        <div class="filter__text checkboxes-info">
            <p data-info="1">Выбранные технологии: -</p>
            <p data-info="2">Выбранные уровни: -</p>
            <!-- <p>Выбранные компании: -</p> -->
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
                            <a href="/topics/<?php echo $this->topic->getAlias() . '/' . $value['alias']; ?>"
                                class="item__title"><?php echo $value['name']; ?></a>
                            <div class="item__tags">
                                <?php foreach ($this->question->findAllTechnologies($value['id_question']) as $inner_key => $inner_value) {?>
                                <a
                                    class="item__tag"><?php echo $this->technology->findById($inner_value['technology_id'])['name']; ?></a>
                                <?php } ?> <a
                                    class="item__tag-level"><?php echo $this->level->findById($this->question->findById($value['id_question'])['level_id'])['name']; ?></a>
                            </div>
                        </div>
                        <div class="item__details">? ответа</div>
                    </div>
                    <div class="item__col item__col-right">
                        <div class="text-wrap">
                            <div class="item__date"><?php echo $this->formatDate($value['created_at']); ?></div>
                            <div class="item__author">
                                <div class="img-cage">
                                    <img src="/uploads/img/<?php echo $this->user->findById($value['author_id'])['avatar']; ?>"
                                        alt="">
                                </div>
                                <p>@<?php echo $this->user->findById($value['author_id'])['username']; ?>,
                                    <span><?php echo $this->user->findById($value['author_id'])['rating']; ?>
                                        опыта</span></p>
                            </div>
                        </div>
                        <div class="item__favourite favourite-btn"></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div> <?php
   require 'views/chunk/footer.php';
?>