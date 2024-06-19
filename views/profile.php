<title><?php echo $this->getUser()['full_name'] . ' – Hackora'; ?></title>
<?php
   require 'chunk/header.php';
?>

            <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная - Профиль</div>
                  <div class="bonnet__title h2">Профиль</div>
                </div>
              </div>
              <?php if ($this->getUser()['role'] == 'U' || $this->getUser()['role'] == 'S') { ?>
              <div class="profile-detail detail content-block">
                <div class="detail__wrapper container">
                  <form class="detail__row" data-url="/edit-profile">
                    <input type="hidden" name="role" value="U">
                    <div class="detail__col detail__col-item item">
                      <div class="item__row item__row-upper">
                        <div class="item__image">
                          <div class="img-cage"><img src="/uploads/img/<?php echo $this->getUser()['avatar']; ?>" alt=""></div>
                        </div>
                        <div class="item__edit">
                            <img src="/resources/img/edit-icon.svg" alt="">
                        </div>
                      </div>
                      <div class="item__row">
                        <div class="item__username">@<?php echo $this->getUser()['username']; ?></div>
                        <div class="item__name"><?php echo $this->getUser()['full_name']; ?></div>
                        <div class="item__mail"><?php echo $this->getUser()['email']; ?></div>
                      </div>
                    </div>
                    <div class="detail__col detail__col-info info-blured">
                      <div class="info__field"><span>Фото в профиле</span>
                        <div class="file-wrap">
                          <label class="file-btn" for="file-upload">Загрузить новое</label>
                          <input class="file-upload" type="file" name="avatar">
                          <div class="file-name"><?php echo $this->getUser()['avatar']; ?></div>
                        </div>
                      </div>
                      <div class="info__field"><span>Имя и фамилия</span>
                        <div class="field-wrap">
                          <input type="text" name="full_name" value="<?php echo $this->getUser()['full_name']; ?>">
                        </div>
                      </div>
                      <div class="info__field"><span>Почта</span>
                        <div class="field-wrap">
                          <input type="mail" name="email" value="<?php echo $this->getUser()['email']; ?>">
                        </div>
                      </div>
                      <div class="info__field"><span>Логин</span>
                        <div class="field-wrap">
                          <input type="text" name="login" value="<?php echo $this->getUser()['username']; ?>">
                        </div>
                      </div>
                      <div class="info__incorrect inc"><p></p></div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="my-vacancies vacancies content-block">
                            <div class="vacancies__wrapper container">
                                <div class="vacancies__title h3">Мои отклики на вакансии</div>
                                <?php if ($this->vacancy->getMyResponces($this->getUser()['id_user'])) { ?>
                                <div class="vacancies__items">
                                    <?php foreach ($this->vacancy->getMyResponces($this->getUser()['id_user']) as $key => $value) { ?>
                                    <div class="vacancies__item vacancies-item item">
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
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } else { ?>
                                  <div class="empty-block empty">
                                    <div class="empty__wrapper container">
                                      <div class="empty__row">
                                        <div class="empty__col empty__col-image">
                                          <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                                        </div>
                                        <div class="empty__col">
                                          <div class="empty__title">Пусто!</div>
                                          <div class="empty__subtitle">Пока вы еще не откликнулись ни на одну вакансию</div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php } ?>
                            </div>
                        </div>
              <?php } ?>
              <?php if ($this->getUser()['role'] == 'A') { ?>
              <div class="profile-detail detail content-section">
                <div class="detail__wrapper container">
                  <div class="detail__row">
                    <div class="detail__col detail__col-item item">
                      <div class="item__row item__row-upper">
                        <div class="item__image">
                          <div class="img-cage"><img src="/uploads/img/<?php echo $this->getUser()['avatar']; ?>" alt=""></div>
                        </div>
                      </div>
                      <div class="item__row">
                        <div class="item__username">@<?php echo $this->getUser()['username']; ?></div>
                        <div class="item__name"><?php echo $this->getUser()['full_name']; ?></div>
                        <div class="item__mail"><?php echo $this->getUser()['email']; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if ($this->getUser()['role'] == 'R' || $this->getUser()['company_id']) { ?>
                <div class="profile-detail detail content-block">
                <div class="detail__wrapper container">
                  <form class="detail__row" data-url="/edit-profile">
                    <input type="hidden" name="role" value="R">
                    <div class="detail__col detail__col-item item">
                      <div class="item__row item__row-upper">
                        <div class="item__image">
                          <div class="img-cage"><img src="/uploads/img/<?php echo $this->getUser()['avatar']; ?>" alt=""></div>
                        </div>
                        <div class="item__edit">
                            <img src="/resources/img/edit-icon.svg" alt="">
                        </div>
                      </div>
                      <div class="item__row">
                        <div class="item__username"><?php echo $this->getUser()['username']; ?></div>
                        <div class="item__name"><?php echo $this->getUser()['full_name']; ?></div>
                        <div class="item__mail"><?php echo $this->getUser()['email']; ?></div>
                      </div>
                    </div>
                    <div class="detail__col detail__col-info info-blured">
                      <div class="info__field"><span>Фото в профиле</span>
                        <div class="file-wrap">
                          <label class="file-btn" for="file-upload">Загрузить новое</label>
                          <input class="file-upload" type="file" name="avatar">
                          <div class="file-name"><?php echo $this->getUser()['avatar']; ?></div>
                        </div>
                      </div>
                      <div class="info__field"><span>Имя и фамилия</span>
                        <div class="field-wrap">
                          <input type="text" name="full_name" value="<?php echo $this->getUser()['full_name']; ?>">
                        </div>
                      </div>
                      <div class="info__field"><span>Почта</span>
                        <div class="field-wrap">
                          <input type="mail" name="email" value="<?php echo $this->getUser()['email']; ?>">
                        </div>
                      </div>
                      <div class="info__field info__field-company"><span>Компания</span>
                        <div class="field-wrap">
                          <input type="text" name="" value="<?php echo $this->company->findById($this->getUser()['company_id'])['name']; ?>" disabled>
                        </div>
                        <div class="field-banner <?php if (!$this->getUser()['role']) echo 'inc'; ?>">
                          <p><?php if (!$this->getUser()['role']) { echo 'Ваш статус находится в обработке.'; } else { echo 'Ваш статус работы в компании подтвержден.'; } ?></p>
                        </div>
                      </div>
                      <div class="info__incorrect inc"><p></p></div>
                    </div>
                  </form>
                </div>
              </div>
                          <div class="my-vacancies vacancies content-block">
                            <div class="vacancies__wrapper container">
                                <div class="vacancies__title h3">Мои вакансии</div>
                                <div class="vacancies__items">
                                    <?php foreach ($this->vacancy->getByAuthor($this->getUser()['id_user']) as $key => $value) { ?>
                                    <div class="vacancies__item vacancies-item item">
                                        <div class="item__row">
                                            <div class="item__col item__col-left">
                                                <div class="item__title btn-ajax" data-url="/ajax/popup.php" data-id="440" data-api="vacanced" data-item="<?php echo $value['vacancy_id']; ?>"><?php echo $value['vacancy_name']; ?></div>
                                                <div class="item__tags">
                                                    <div class="item__tag"><?php echo $value['vacancy_level']; ?></div>
                                                    <div class="item__tag item__tag-company"><?php echo $value['vacancy_company']; ?></div>
                                                    <div class="item__tag item__tag-inq"><?php echo count($this->vacancy->getResponses($value['id_vacancy'])); ?> откликов</div>
                                                </div>
                                            </div>
                                            <div class="item__col item__col-right">
                                                <form data-url="/remove-vacancy" class="confirm-remove" data-confirm="Вы хотите удалить данную вакансию? Будут потеряны все отклики на нее" data-positive="Удалить">
                                                  <input type="hidden" name="vacancy_id" value="<?php echo $value['id_vacancy']; ?>">
                                                  <button type="submit" class="item__remove remove-btn"></button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="item__row item__row-bottom">
                                            <div class="item__text"><?php echo $value['vacancy_text']; ?></div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="vacancies__item vacancies-item item item-more">
                                        <div class="item__row">
                                            <p>Нужно найти больше соискателей? Всегда можно добавить еще одну!</p>
                                            <div class="btn btn-ajax" data-url="/ajax/popup.php" data-id="439" data-api="levels/positions" data-user="<?php echo $this->getAuth(); ?>">Добавить вакансию</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
              <?php } ?>
              <?php if ($this->getUser()['role'] == 'A') { ?>
                <div class="profile-table table content-block">
                            <div class="table__wrapper container">
                                <div class="table__items">
                                    <div class="table__item">
                                        <div class="table__col table__col-upper">
                                            <div class="table__title">Темы (<?php echo count($this->topic->getAll()); ?>)</div>
                                        </div>
                                        <div class="table__col">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td>Тема</td>
                                                        <td>Тема-родитель</td>
                                                        <td>Статус</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($this->topic->getAll() as $key => $value) { ?>
                                                    <tr>
                                                        <td><a href="/topics/<?php echo $value['topic_alias']; ?>?main_topic=<?php echo $value['main_topic_id']; ?>"><?php echo $value['topic_name']; ?></a></td>
                                                        <td><?php echo $value['main_topic_name']; ?></td>
                                                        <td><?php if($this->topic->isValidated($value['topic_id'])) { echo 'Подтвержден'; } else echo 'Ожидает подтверждения'; ?></td>
                                                        <td class="td-actions">
                                                          <form data-url="/validate-topic">
                                                            <input type="hidden" name="topic_id" value="<?php echo $value['topic_id']; ?>">
                                                            <?php if($this->topic->isValidated($value['topic_id'])) { ?>
                                                            <button type="submit" class="btn-text">Отменить</button>
                                                            <?php } else { ?>
                                                            <button type="submit" class="btn-text">Подтвердить</button>
                                                            <?php }; ?>
                                                          </form>
                                                          <form data-url="/remove-topic" class="confirm-remove" data-confirm="Вы хотитет удалить данный вопрос? Будут потеряны все ответы на него" data-positive="Удалить">
                                                            <input type="hidden" name="topic_id" value="<?php echo $value['topic_id'];?>">
                                                            <button type="submit" class="btn-text">Удалить</button>
                                                          </form>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php if (count($this->topic->getAll()) > 4) { ?>
                                        <div class="table__row">
                                            <div class="btn-sm btn-red">Скрыть</div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="table__item">
                                        <div class="table__col table__col-upper">
                                            <div class="table__title">Вопросы (<?php echo count($this->question->getAll()); ?>)</div>
                                        </div>
                                        <div class="table__col">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td>Вопрос</td>
                                                        <td>Тема</td>
                                                        <td>Статус</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($this->question->getAll() as $key => $value) { ?>
                                                    <tr>
                                                        <td><a href="/topics/<?php echo $value['topic_alias'] . '/' . $value['question_alias']; ?>"><?php echo $value['question_name']; ?></a></td>
                                                        <td><?php echo $value['topic_name']; ?></td>
                                                        <td><?php if($this->question->isValidated($value['question_id'])) { echo 'Подтвержден'; } else echo 'Ожидает подтверждения'; ?></td>
                                                        <td class="td-actions">
                                                          <form data-url="/validate-question">
                                                            <input type="hidden" name="question_id" value="<?php echo $value['question_id']; ?>">
                                                            <?php if($this->question->isValidated($value['question_id'])) { ?>
                                                            <button type="submit" class="btn-text">Отменить</button>
                                                            <?php } else { ?>
                                                            <button type="submit" class="btn-text">Подтвердить</button>
                                                            <?php }; ?>
                                                          </form>
                                                          <form data-url="/remove-question" class="confirm-remove" data-confirm="Вы хотитет удалить данный вопрос? Будут потеряны все ответы на него" data-positive="Удалить">
                                                            <input type="hidden" name="question_id" value="<?php echo $value['question_id'];?>">
                                                            <button type="submit" class="btn-text">Удалить</button>
                                                          </form>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php if (count($this->question->getAll()) > 4) { ?>
                                        <div class="table__row">
                                            <div class="btn-sm btn-red">Скрыть</div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="table__item">
                                        <div class="table__col table__col-upper">
                                            <div class="table__title">Рекрутеры (<?php echo count($this->user->getRecruiters()); ?>)</div>
                                        </div>
                                        <div class="table__col">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td>Имя</td>
                                                        <td>Почта</td>
                                                        <td>Логин</td>
                                                        <td>Компания</td>
                                                        <td style="white-space: nowrap;">Документ</td>
                                                        <td>Статус</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($this->user->getRecruiters() as $key => $value) { ?>
                                                    <tr>
                                                      <td><?php echo $value['full_name']; ?></td>
                                                        <td><?php echo $value['email']; ?></td>
                                                        <td><?php echo $value['username']; ?></td>
                                                        <td><?php echo $value['name']; ?></td>
                                                        <td><a style="text-decoration: underline;" href="/uploads/recruiters/<?php echo $value['document_url']; ?>" target="_blank">Открыть</a></td>
                                                        <td><?php if($this->user->isValidated($value['id_user'])) { echo 'Подтвержден'; } else echo 'Ожидает подтверждения'; ?></td>
                                                        <td>
                                                          <form data-url="/validate-recruiter">
                                                            <input type="hidden" name="id_user" value="<?php echo $value['id_user']; ?>">
                                                            <?php if($this->user->isValidated($value['id_user'])) { ?>
                                                            <button type="submit" class="btn-text">Отменить</button>
                                                            <?php } else { ?>
                                                            <button type="submit" class="btn-text">Подтвердить</button>
                                                            <?php }; ?>
                                                          </form>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php if (count($this->question->getAll()) > 4) { ?>
                                        <div class="table__row">
                                            <div class="btn-sm btn-red">Скрыть</div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
              <?php } ?>
              <!-- <div class="my-inq inq content-block">
                <div class="inq__wrapper container">
                  <div class="inq__title h3">Мои отклики</div>
                  <div class="inq__items">
                    <div class="inq__item vacancies-item item">
                      <div class="item__row">
                        <div class="item__col item__col-left">
                          <div class="item__title">Project Manager</div>
                          <div class="item__tag">джуниор</div>
                          <div class="item__rating">Необходимый рейтинг – <span>24</span>/20</div>
                          <div class="item__inq">15 откликов</div>
                        </div>
                      </div>
                      <div class="item__row item__row-bottom">
                        <div class="item__company">
                          <div class="img-cage"><img src="img/epam.png" alt=""></div>
                        </div>
                        <div class="btn btn-green">Вы откликнулись</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- <div class="fav-companies fav content-block">
                <div class="fav__wrapper container">
                  <div class="fav__title h3">Компании в избранном</div>
                  <div class="fav__items">
                    <div class="fav__item companies-item item">
                      <div class="item__row">
                        <div class="item__col item__col-left">
                          <div class="item__image"><img src="img/epam.png" alt=""></div>
                          <div class="item__questions">22 вопроса</div>
                          <div class="item__vacancies">1 вакансия</div>
                        </div>
                        <div class="item__col item__col-right">
                          <div class="item__favourite favourite-btn favourite-btn-selected"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- <div class="fav-positions fav content-block">
                <div class="fav__wrapper container">
                  <div class="fav__title h3">Позиции в избранном</div>
                  <div class="fav__items">
                    <div class="fav__item positions-item item">
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
                  </div>
                </div>
              </div> -->
              <!-- <div class="fav-questions fav content-block">
                <div class="fav__wrapper container">
                  <div class="fav__title h3">Мои вопросы</div>
                  <div class="fav__items">
                    <div class="fav__item questions-item item">
                      <div class="item__row">
                        <div class="item__col item__col-left">
                          <div class="text-wrap">
                            <div class="item__title">В чем разница между having и in в SQ?</div>
                            <div class="item__tags"><a class="item__tag">swift</a><a class="item__tag">javascript</a><a class="item__tag">java</a><a class="item__tag">c#</a><a class="item__tag">c++</a></div>
                          </div>
                          <div class="item__details">2 голоса&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3 ответа</div>
                        </div>
                        <div class="item__col item__col-right">
                          <div class="text-wrap">
                            <div class="item__date">2 часа назад</div>
                            <div class="item__author">
                              <div class="img-cage"><img src="img/avatar.png" alt=""></div>
                              <p>@diana, <span>Frontend-разработчик</span></p>
                            </div>
                          </div>
                          <div class="item__favourite favourite-btn favourite-btn-selected"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->

<?php
   require 'chunk/footer.php';
?>