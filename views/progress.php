<?php
   require 'chunk/header.php';
?>

               <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная / Прогресс</div>
                  <div class="bonnet__title h2">Прогресс</div>
                </div>
              </div>
              <!-- <div class="select-theme theme content-section">
                <div class="theme__wrapper container">
                  <div class="theme__box">
                    <div class="theme__col theme__col-left">
                      <p>Выбранное направление – <span>Frontend разработчик</span></p>
                    </div>
                    <div class="theme__col theme__col-right">
                      <div class="select">
                        <div class="select__item">
                          <div class="item">
                            <div class="item__head">
                              <span>Выберите направление</span>
                              <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 1L5 5L9 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                            </div>
                            <div class="item__options">
                              <input type="hidden" name="">
                              <div class="option-wrap">
                                <input class="item__option" type="radio" name="" data-text="Frontend разработчик" data-selected-value="1">
                                <label>Frontend разработчик</label>
                              </div>
                              <div class="option-wrap">
                                <input class="item__option" type="radio" name="" data-text="Backend разработчик" data-selected-value="2">
                                <label>Backend разработчик</label>
                              </div>
                              <div class="option-wrap">
                                <input class="item__option" type="radio" name="" data-text="gregr" data-selected-value="4">
                                <label>gregr</label>
                              </div>
                              <div class="option-wrap">
                                <input class="item__option" type="radio" name="" data-text="gergreger5t43" data-selected-value="5">
                                <label>gergreger5t43</label>
                              </div>
                              <div class="option-wrap">
                                <input class="item__option" type="radio" name="" data-text="vfdvdv" data-selected-value="6">
                                <label>vfdvdv</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="btn">Выбрать</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="progress-radios progress content-section">
                <div class="progress__wrapper container">
                  <div class="progress__radios radios">
                    <div class="radio">
                      <input type="radio" name="" id="r_1" checked>
                      <label for="r_1">Вопросы из избранного</label>
                    </div>
                    <div class="radio">
                      <input type="radio" name="" id="r_2">
                      <label for="r_2">Вопросы из категории</label>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- <div class="progress-circle circle content-block">
                <div class="circle__wrapper container">
                  <div class="circle__item" style="--percent: 28;">
                    <p>28%</p>
                  </div>
                  <div class="circle__text">
                    <p>Процент прогресса считается из расчета отмеченных пройденных вопросов к общему количеству из категории.</p>
                    <div class="done">Пройдено вопросов – <span>14/24</span></div>
                  </div>
                </div>
              </div> -->
              <div class="completed-questions completed content-block">
                <div class="completed__wrapper container">
                  <div class="completed__title h3">Пройденные вопросы</div>
                  <div class="completed__items items">
                    <?php foreach ($this->getCompleted() as $key => $value) { ?>
                      <div class="completed__item questions-item item">
                      <div class="item__row">
                        <div class="item__col item__col-left">
                          <div class="text-wrap">
                            <a class="item__title" href="/topics/<?php echo $value['subtopic_alias'] . '/' . $value['alias']; ?>"><?php echo $value['name']; ?></a>
                            <div class="item__tags">
                              <?php foreach ($value['tags'] as $inner_key => $inner_value) { ?>
                                <a class="item__tag"><?php echo $inner_value['name']; ?></a>
                              <?php } ?>
                              <a class="item__tag-level"><?php echo $value['level_name']; ?></a>
                            </div>
                          </div>
                          <div class="item__details">2 голоса&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3 ответа</div>
                        </div>
                        <div class="item__col item__col-right">
                          <div class="text-wrap">
                            <div class="item__date"><?php echo $value['created_at']; ?></div>
                            <div class="item__author">
                              <div class="img-cage"><img src="/uploads/img/<?php echo $value['avatar']; ?>" alt=""></div>
                              <p>@<?php echo $value['username']; ?>, <span><?php echo $value['rating']; ?> опыта</span></p>
                            </div>
                          </div>
                          <!-- <div class="item__remove remove-btn"></div> -->
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

<?php
   require 'chunk/footer.php';
?>