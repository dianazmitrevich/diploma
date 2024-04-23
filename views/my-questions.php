<?php
   require 'chunk/header.php';
?>

              <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная / Мои вопросы и темы</div>
                  <div class="bonnet__title h2">Мои вопросы</div>
                </div>
              </div>
              <!-- <div class="themes-filter filter">
                <div class="filter__wrapper container">
                  <div class="filter__boxes">
                    <div class="checkbox">
                      <input type="checkbox" name="" id="c_1">
                      <label for="c_1">Открытый</label>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="" id="c_2" checked>
                      <label for="c_2">Закрытый</label>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="questions-list list content-block">
                <div class="list__wrapper container">
                  <?php foreach ($this->getMyQuestions() as $key => $value) { ?>
                  <div class="list__item questions-item item">
                    <div class="item__row">
                      <div class="item__col item__col-left">
                        <div class="text-wrap">
                          <div class="item__title"><?php echo $value['name']; ?></div>
                          <div class="item__tags">
                            <?php foreach ($this->question->getTechnologiesList($value['id_question']) as $inner_key => $inner_value) { ?>
                            <a class="item__tag"><?php echo $inner_value['name']; ?></a>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="item__details">2 голоса&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3 ответа&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9 апреля 23:59</div>
                      </div>
                      <!-- <div class="item__col item__col-right">
                        <div class="btn btn-green">Пометить как закрытый</div>
                      </div> -->
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="my-themes-list list content-block">
                <div class="list__wrapper container">
                  <div class="list__title h2">Мои темы</div>
                  <div class="list__items">
                    <?php foreach ($this->getMyTopics() as $key => $value) { ?>
                    <a class="list__item theme-item item"><?php echo $value['name']; ?> <span><?php echo $this->getQuestionsCount($value['id_topic']); ?> вопросов</span></a>
                    <?php } ?>
                  </div>
                  <div class="list__more">
                    <p>Нет подходящей темы? Всегда можно добавить еще одну!</p>
                    <div class="btn btn-ajax" data-url="/ajax/popup.php" data-id="438" data-api="main_topics" data-user="<?php echo $this->getAuth(); ?>">Добавить тему</div>
                  </div>
                </div>
              </div>

<?php
   require 'chunk/footer.php';
?>