<?php
   require 'views/chunk/header.php';
?>

              <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная / Темы / <?php echo $this->topic->getName(); ?></div>
                  <div class="bonnet__title h2"><?php echo $this->topic->getName(); ?></div>
                </div>
              </div>
              <div class="questions-filter filter">
                <div class="filter__wrapper container">
                  <div class="filter__cages checkboxes-ajax" data-id="126" data-url="/ajax/api.php" data-element="126" data-api="questions">
                    <div class="filter__cage cage">
                      <div class="cage__title">Технологии</div>
                      <div class="cage__wrap">
                        <div class="cage__boxes">
                          <input type="hidden" name="filter_techs" value="<?php echo $this->getTechIds(); ?>">
                          <?php foreach ($this->topic->getTechs() as $key => $value) {?>
                            <div class="checkbox">
                              <input type="checkbox" name="" checked id="tech_<?php echo $value['id_tech']; ?>" data-id="<?php echo $value['id_tech']; ?>">
                            <label for="tech_<?php echo $value['id_tech']; ?>"><?php echo $value['name']; ?></label>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="filter__cage cage">
                      <div class="cage__title">Уровень</div>
                      <div class="cage__wrap">
                        <div class="cage__boxes">
                          <input type="hidden" name="filter_levels" value="<?php echo $this->getLevelsIds(); ?>">
                          <?php foreach ($this->topic->getLevels() as $key => $value) {?>
                            <div class="checkbox">
                              <input type="checkbox" name="" checked id="level_<?php echo $value['id_level']; ?>" data-id="<?php echo $value['id_level']; ?>">
                            <label for="level_<?php echo $value['id_level']; ?>"><?php echo $value['name']; ?></label>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="questions-list list">
                <div class="list__wrapper container">
                  <div id="126">
                  <?php foreach ($this->topic->getQuestions() as $key => $value) {?>
                    <div class="list__item questions-item item">
                      <div class="item__row">
                        <div class="item__col item__col-left">
                          <div class="text-wrap">
                            <a href="/topics/<?php echo $this->topic->getAlias() . '/' . mb_substr(md5($value['id_question']), 0, 5); ?>" class="item__title"><?php echo $value['name']; ?></a>
                            <div class="item__tags">
                              <?php foreach ($this->question->findAllTechnologies($value['id_question']) as $inner_key => $inner_value) {?>
                                <a class="item__tag"><?php echo $this->technology->findById($inner_value['technology_id'])['name']; ?></a>
                              <?php } ?>
                              <a class="item__tag-level"><?php echo $this->level->findById($this->question->findById($value['id_question'])['level_id'])['name']; ?></a>
                            </div>
                          </div>
                          <div class="item__details">2 голоса&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3 ответа</div>
                        </div>
                        <div class="item__col item__col-right">
                          <div class="text-wrap">
                            <div class="item__date"><?php echo $value['created_at']; ?></div>
                            <div class="item__author">
                              <div class="img-cage">
                                <img src="/uploads/img/<?php echo $this->user->findById($value['author_id'])['avatar']; ?>" alt=""></div>
                              <p>@<?php echo $this->user->findById($value['author_id'])['username']; ?>, <span><?php echo $this->user->findById($value['author_id'])['rating']; ?> опыта</span></p>
                            </div>
                          </div>
                          <div class="item__favourite favourite-btn"></div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </div>

<?php
   require 'views/chunk/footer.php';
?>