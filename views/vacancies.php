<title><?php echo 'Вакансии (' . count($this->vacancy->getAll()) . ') – Hackora'; ?></title>
<?php
   require 'chunk/header.php';
?>

              <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная - Вакансии</div>
                  <div class="bonnet__title h2">Вакансии</div>
                </div>
              </div>
              <div class="vacancies-filter filter content-section">
                <div class="filter__wrapper container">
                  <div class="filter__boxes checkboxes-ajax" data-id="127" data-url="/ajax/api.php" data-element="127" data-api="vacancies" data-user="<?php echo $this->getUser()['id_user']; ?>" data-role="<?php echo $this->getUser()['role']; ?>">
                    <div class="filter__box">
                      <div class="box-title">Позиции</div>
                      <div class="box-checkboxes checkboxes-filled">
                        <input type="hidden" name="vacancies_positions">
                        <?php foreach ($this->topic->readPositions() as $key => $value) { ?>
                        <div class="checkbox">
                          <input type="checkbox" name="" id="t_<?php echo $value['id_topic']; ?>" data-id="<?php echo $value['id_topic']; ?>">
                          <label for="t_<?php echo $value['id_topic']; ?>"><?php echo $value['name']; ?></label>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="filter__box">
                      <div class="box-title">Компании</div>
                      <div class="box-checkboxes checkboxes-filled">
                        <input type="hidden" name="vacancies_companies">
                        <?php foreach ($this->company->getAll() as $key => $value) { ?>
                        <div class="checkbox">
                          <input type="checkbox" name="" id="c_<?php echo $value['id_company']; ?>" data-id="<?php echo $value['id_company']; ?>">
                          <label for="c_<?php echo $value['id_company']; ?>"><?php echo $value['name']; ?></label>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php if (!$this->vacancy->getAll()) { ?>
              <div class="empty-block empty">
                <div class="empty__wrapper container">
                  <div class="empty__row">
                    <div class="empty__col empty__col-image">
                      <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                    </div>
                    <div class="empty__col">
                      <div class="empty__title">Пусто!</div>
                      <div class="empty__subtitle">Пока ни одна компания еще не оставила вакансию. Подождите немного, скоро здесь что-то появится! 😁</div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } else { ?>
              <div class="vacancies-list list content-block">
                <div class="list__wrapper container">
                  <div class="list__items">
                    <div id="127">
                                <?php foreach ($this->vacancy->getAll() as $key => $value) { ?>
                                      <div class="list__item vacancies-item item">
                                        <div class="item__row">
                                            <div class="item__col item__col-left">
                                                <div class="item__title"><?php echo $value['vacancy_name']; ?></div>
                                                <div class="item__tags">
                                                    <div class="item__tag"><?php echo $value['vacancy_level']; ?></div>
                                                    <div class="item__tag item__tag-company"><?php echo $value['vacancy_company']; ?></div>
                                                    <div class="item__tag item__tag-inq"><?php echo count($this->vacancy->getResponses($value['id_vacancy'])); ?> откликов</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item__row item__row-bottom">
                                            <div class="item__text"><?php echo $value['vacancy_text']; ?></div>
                                            <?php if ($this->getAuth() && $this->getUser()['role'] !== 'R' && $this->getUser()['role'] !== 'A') { ?>
                                            <form <?php if (!$this->vacancy->isVacanced($value['id_vacancy'], $this->getUser()['id_user'])) { ?>data-url="/vacancy-response"<?php } ?>>
                                              <input type="hidden" name="user_id" value="<?php echo $this->getUser()['id_user']; ?>">
                                              <input type="hidden" name="vacancy_id" value="<?php echo $value['id_vacancy']; ?>">
                                              <?php if (!$this->vacancy->isVacanced($value['id_vacancy'], $this->getUser()['id_user'])) { ?>
                                              <button type="submit" class="btn">Откликнуться</button>
                                              <?php } else { ?>
                                              <button class="btn btn-green">Вы откликнулись</button>
                                              <?php } ?>
                                            </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                                  <?php } ?>
                      </div>
                  </div>
                </div>
              </div>
              <?php } ?>

<?php
   require 'chunk/footer.php';
?>