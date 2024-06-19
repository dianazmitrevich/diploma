<title><?php echo 'Прогресс – Hackora'; ?></title>
<?php
   require 'chunk/header.php';
?>

               <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная - Прогресс</div>
                  <div class="bonnet__title h2">Прогресс</div>
                </div>
              </div>
              <div class="progress-filter filter content-section">
                <div class="filter__wrapper container">
                  <div class="filter__boxes">
                    <div class="filter__box">
                      <div class="box-title">Темы</div>
                      <div class="box-checkboxes checkboxes-filled checkboxes-ajax" data-url="/progress-topics">
                        <input type="hidden" name="progress_themes">
                        <?php foreach ($this->topic->readAllSubTopics() as $key => $value) { ?>
                        <div class="checkbox">
                          <input type="checkbox" name="" id="t_<?php echo $value['id_topic']; ?>" data-id="<?php echo $value['id_topic']; ?>">
                          <label for="t_<?php echo $value['id_topic']; ?>"><?php echo $value['name']; ?> (<?php echo $this->topic->getQuestionsCount($value['id_topic']); ?>)</label>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="progress-circle circle content-block">
                <div class="circle__wrapper container">
                  <div class="circle__item" style="--percent: 0;">
                    <p>0%</p>
                  </div>
                  <div class="circle__text">
                    <p>Процент прогресса считается из расчета отмеченных пройденных вопросов к общему количеству из темы.</p>
                    <div class="done">Пройдено вопросов – <span>0/0</span></div>
                  </div>
                </div>
              </div>
              <div class="completed-questions completed content-block">
                <div class="completed__wrapper container">
                  <div class="completed__title h3">Пройденные вопросы</div>
                  <?php if (!$this->getCompleted()) { ?>
                    <div class="empty-block empty">
                      <div class="empty__wrapper container">
                      <div class="empty__row">
                          <div class="empty__col empty__col-image">
                          <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                          </div>
                          <div class="empty__col">
                          <div class="empty__title">Пусто!</div>
                          <div class="empty__subtitle">Вы не отметили пройденным еще ни один вопрос. Чтобы отметить, перейдите на страницу вопроса и поставьте галочку</div>
                          </div>
                      </div>
                      </div>
                  </div>
                  <?php } else { ?>
                  <div class="completed__items items">
                    <?php foreach ($this->getCompleted() as $key => $value) { ?>
                      <div class="completed__item questions-item item">
                      <div class="item__row">
                        <div class="item__col item__col-left">
                          <div class="text-wrap">
                            <div class="item__details"><?php echo count($this->question->getRepliesList($value['id_question'])); ?> ответа</div>
                            <a class="item__title" href="/topics/<?php echo $value['subtopic_alias'] . '/' . $value['alias']; ?>"><?php echo $value['name']; ?></a>
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
                          <div class="text-wrap">
                            <div class="item__author">
                              <div class="img-cage"><img src="/uploads/img/<?php echo $value['avatar']; ?>" alt=""></div>
                              <?php if ($value['role'] === 'R') { ?>
                                <p><?php echo $value['username']; ?>
                                    <span class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->formatDate($value['created_at']); ?></span>
                                </p>
                                <?php } else { ?>
                                <p>@<?php echo $value['username']; ?>,
                                    <span><?php echo $value['rating']; ?> опыта</span>
                                    <span class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->formatDate($value['created_at']); ?></span>
                                </p>
                              <?php } ?>
                        </div>
                          </div>
                          <form data-url="/remove-completed" class="confirm-remove" data-confirm="Вы хотите убрать данный вопрос из пройденных?" data-positive="Убрать">
                            <input type="hidden" name="question_id" value="<?php echo $value['id_question'];?>">
                            <input type="hidden" name="user_id" value="<?php echo $this->getUser()['id_user'];?>">
                            <button type="submit" class="item__remove remove-btn"></button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>
              </div>

<?php
   require 'chunk/footer.php';
?>