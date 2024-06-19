<title><?php echo 'Избранное – Hackora'; ?></title>
<?php
   require 'chunk/header.php';
?>

              <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная - Избранное</div>
                  <div class="bonnet__title h2">Вопросы</div>
                </div>
              </div>
              <?php if (!$this->getFavedQuestions()) { ?>
                <div class="empty-block empty">
                      <div class="empty__wrapper container">
                      <div class="empty__row">
                          <div class="empty__col empty__col-image">
                          <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                          </div>
                          <div class="empty__col">
                          <div class="empty__title">Пусто!</div>
                          <div class="empty__subtitle">Вы пока еще не добавили ничего в избранное</div>
                          </div>
                      </div>
                      </div>
                  </div>
              <?php } else { ?>
              <div class="questions-list list content-block">
                <div class="list__wrapper container">
                  <?php foreach ($this->getFavedQuestions() as $key => $value) { ?>
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
                        <div class="text-wrap">
                            <div class="item__author">
                                <div class="img-cage">
                                    <img src="/uploads/img/<?php echo $value['avatar']; ?>"
                                        alt="">
                                </div>
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
                        <?php if ($this->getAuth()) { ?>
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
              <?php } ?>

<?php
   require 'chunk/footer.php';
?>