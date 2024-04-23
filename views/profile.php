<?php
   require 'chunk/header.php';
?>

            <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная / Профиль</div>
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
                      <div class="info__field info__field-company"><span>Компания</span>
                        <div class="field-wrap">
                          <input type="text" name="" value="<?php echo $this->getUser()['company_id'] ?>" disabled>
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