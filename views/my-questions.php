<title><?php echo 'Мои вопросы – Hackora'; ?></title>
<?php
   require 'chunk/header.php';
?>

              <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная - Мои вопросы и темы</div>
                  <div class="bonnet__title h2">Мои вопросы</div>
                </div>
              </div>
              <?php if (!$this->getMyQuestions()) { ?>
                <div class="empty-block empty">
                      <div class="empty__wrapper container">
                      <div class="empty__row">
                          <div class="empty__col empty__col-image">
                          <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                          </div>
                          <div class="empty__col">
                          <div class="empty__title">Пусто!</div>
                          <div class="empty__subtitle">Вы не задали пока еще ни один вопрос. Чтобы задать, нажмите на кнопку "Задать вопрос" вверху</div>
                          </div>
                      </div>
                      </div>
                  </div>
              <?php } else { ?>
              <div class="questions-list list content-block">
                <div class="list__wrapper container">
                  <?php foreach ($this->getMyQuestions() as $key => $value) { ?>
                  <div class="list__item questions-item item">
                    <div class="item__row">
                      <div class="item__col item__col-left">
                        <div class="text-wrap">
                          <div class="item__details"><?php echo count($this->question->getRepliesList($value['id_question'])); ?> ответа</div>
                          <a href="/topics/<?php echo $value['subtopic_alias'] . '/' . $value['alias']; ?>" class="item__title"><?php echo $value['name']; ?></a>
                          <div class="item__tags">
                              <?php foreach ($value['tags'] as $inner_key => $inner_value) { ?>
                                <a class="item__tag"><?php echo $inner_value['name']; ?></a>
                              <?php } ?>
                              <a class="item__tag-level"><?php echo $value['level_name']; ?></a>
                              <?php if ($this->question->isValidated($value['id_question'])) {?><a class="item__tag-validated">Подтвержден</a><?php } ?>
                              <?php if ($value['role'] === 'R') { ?><a class="item__tag-recruiter">Вопрос рекрутера</a><?php } ?>
                            </div>
                        </div>
                      </div>
                      <div class="item__col item__col-right">
                        <form data-url="/remove-question" class="confirm-remove" data-confirm="Вы хотитет удалить данный вопрос? Будут потеряны все ответы на него" data-positive="Удалить">
                          <input type="hidden" name="question_id" value="<?php echo $value['id_question'];?>">
                          <button type="submit" class="item__remove remove-btn"></button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <?php } ?>
              <div class="my-themes-list list content-block">
                <div class="list__wrapper container">
                  <div class="list__title h2">Мои темы</div>
                  <?php if (!$this->getMyTopics()) { ?>
                  <div class="empty-block empty">
                        <div class="empty__wrapper container">
                        <div class="empty__row">
                            <div class="empty__col empty__col-image">
                            <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                            </div>
                            <div class="empty__col">
                            <div class="empty__title">Пусто!</div>
                            <div class="empty__subtitle">Вы не добавили пока еще ни одну тему</div>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php } else { ?>
                  <div class="list__items">
                    <?php foreach ($this->getMyTopics() as $key => $value) { ?>
                    <a href="/topics/<?php echo $value['alias']; ?>?main_topic=<?php echo $value['topic_id']; ?>" class="list__item theme-item item"><?php echo $value['name']; ?><span><?php echo $this->getQuestionsCount($value['id_topic']); ?> вопросов</span></a>
                    <?php } ?>
                  </div>
                <?php } ?>
                  <div class="list__more">
                    <p>Нет подходящей темы? Всегда можно добавить еще одну!</p>
                    <div class="btn btn-ajax" data-url="/ajax/popup.php" data-id="438" data-api="main_topics" data-user="<?php echo $this->getAuth(); ?>">Добавить тему</div>
                  </div>
                </div>
              </div>

<?php
   require 'chunk/footer.php';
?>