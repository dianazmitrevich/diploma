<?php
   require 'views/chunk/header.php';
?> <div class="bonnet">
    <div class="bonnet__wrapper container">
        <div class="bonnet__line">Главная - Темы -
            <?php echo $this->topic->findById($question['subtopic_id'])['name']; ?> - #
            <?php echo $this->question->getAlias(); ?></div>
    </div>
</div>
<div class="questions-single single content-block">
    <div class="single__wrapper container">
        <div class="single__item questions-item item">
            <div class="item__row">
                <div class="item__col item__col-left">
                    <div class="text-wrap">
                        <div class="item__title"><?php echo $question['name']; ?></div>
                        <div class="item__tags">
                            <?php foreach ($this->question->getTechnologiesList() as $key => $value) { ?> <a
                                class="item__tag"><?php echo $value['name']; ?></a> <?php } ?>
                        </div>
                    </div>
                    <div class="item__details"><?php echo count($this->question->getReplies()); ?> ответа</div>
                </div>
                <div class="item__col item__col-right">
                    <div class="text-wrap">
                        <div class="item__date"><?php echo $this->formatDate($question['created_at']); ?></div>
                        <div class="item__author">
                            <div class="img-cage"><img src="img/avatar.png" alt=""></div>
                            <p>@<?php echo $this->user->findById($question['author_id'])['username']; ?>,
                                <span><?php echo $this->user->findById($question['author_id'])['rating']; ?>
                                    опыта</span></p>
                        </div>
                    </div>
                    <div class="item__favourite favourite-btn"></div>
                </div>
            </div>
        </div>
        <div class="single__desc"><?php echo $question['description']; ?></div>
        <div class="single__checkbox checkbox-ajax" data-url="/edit-completed">
            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
            <div class="checkbox">
                <input <?php if ($this->question->getCompleted()) echo 'checked'; ?> type="checkbox"
                    id="comp_<?php echo $question['id_question']; ?>" data-id="<?php echo $question['id_question']; ?>">
                <label for="comp_<?php echo $question['id_question']; ?>">отметить как пройденный</label>
            </div>
        </div>
    </div>
</div>
<div class="question-replies replies">
    <div class="replies__wrapper container">
        <div class="replies__title">
            <div class="wrap">
                <div class="h3"><?php echo count($this->question->getReplies()); ?> ответа</div>
            </div>
            <div class="wrap">
                <div class="replies__sorting sorting select">
                    <div class="select__item">
                        <div class="item">
                            <div class="item__head"><span>Сортировка</span><svg width="10" height="6" viewBox="0 0 10 6"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L5 5L9 1" stroke="#D3D3D3" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg></div>
                            <div class="item__options"><input type="hidden" name="">
                                <div class="option-wrap"><input class="item__option" type="radio" name=""
                                        data-text="По популярности" data-selected-value="1"><label>По
                                        популярности</label>
                                </div>
                                <div class="option-wrap"><input class="item__option" type="radio" name=""
                                        data-text="Недавние" data-selected-value="2"><label>Недавние</label></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="replies__items">
            <?php foreach ($this->question->getReplies() as $key => $value) { ?>
                <div class="replies__item item">
                <div class="item__row">
                    <input type="hidden" name="reply_id" value="<?php echo $value['id_reply']; ?>">
                    <input type="hidden" name="question_id" value="<?php echo $value['question_id']; ?>">
                    <div class="item__upper">
                        <div class="item__author">
                            <div class="item__author-image"><img src="/uploads/img/<?php echo $value['avatar']; ?>"
                                    alt="">
                            </div>
                            <div class="item__author-name">@<?php echo $value['username']; ?></div>
                        </div>
                        <div class="item__date"><?php echo $this->formatDate($value['created_at']); ?></div>
                    </div>
                    <div class="item__text"><?php echo $value['text']; ?></div>
                    <div class="item__rate rate">
                        <div class="rate-up rate-block checkbox-ajax" data-url="/like-reply">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <input
                                type="checkbox"
                                <?php if ($this->reply->isReplyRated($value['id_reply'], $this->getUser()['id_user']) && $this->reply->isReplyRated($value['id_reply'], $this->getUser()['id_user'])['parameter'] == 'L') { echo 'checked';} ?>
                                id="l_<?php echo $value['id_reply']; ?>"
                                name="n_<?php echo $value['id_reply']; ?>"
                                data-id="<?php echo $value['id_reply']; ?>"
                            >
                            <label for="l_<?php echo $value['id_reply']; ?>"></label>
                            <p class="rating-like"><?php echo $value['rating_l']; ?></p>
                        </div>
                        <div class="rate-down rate-block checkbox-ajax" data-url="/dislike-reply">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <input
                                type="checkbox" <?php if ($this->reply->isReplyRated($value['id_reply'], $this->getUser()['id_user']) && $this->reply->isReplyRated($value['id_reply'], $this->getUser()['id_user'])['parameter'] == 'D') { echo 'checked';} ?>
                                id="d_<?php echo $value['id_reply']; ?>"
                                name="n_<?php echo $value['id_reply']; ?>"
                                data-id="<?php echo $value['id_reply']; ?>"
                            >
                            <label for="d_<?php echo $value['id_reply']; ?>"></label>
                            <p class="rating-dislike"><?php echo $value['rating_d']; ?></p>
                        </div>
                        <div class="rate-reply">Ответить</div>
                    </div>
                </div>
                <?php foreach ($this->question->getSubReplies($value['id_reply']) as $key_inner => $value_inner) { ?>
                <div class="item__row-sm">
                    <input type="hidden" name="reply_id" value="<?php echo $value['id_reply']; ?>">
                    <input type="hidden" name="question_id" value="<?php echo $value['question_id']; ?>">
                    <div class="item__upper">
                        <div class="item__author">
                            <div class="item__author-image">
                                <img src="/uploads/img/<?php echo $value_inner['avatar']; ?>" alt="">
                            </div>
                            <div class="item__author-name">@<?php echo $value_inner['username']; ?></div>
                        </div>
                        <div class="item__date"><?php echo $this->formatDate($value_inner['created_at']); ?></div>
                    </div>
                    <div class="item__text"><?php echo $value_inner['text']; ?></div>
                    <div class="item__rate rate">
                        <div class="rate-up rate-block checkbox-ajax" data-url="/like-reply">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <input
                                type="checkbox" <?php if ($this->reply->isReplyRated($value_inner['id_reply'], $this->getUser()['id_user']) && $this->reply->isReplyRated($value_inner['id_reply'], $this->getUser()['id_user'])['parameter'] == 'L') { echo 'checked';} ?>
                                id="l_<?php echo $value_inner['id_reply']; ?>" name="n_<?php echo $value_inner['id_reply']; ?>" data-id="<?php echo $value_inner['id_reply']; ?>">
                            <label for="l_<?php echo $value_inner['id_reply']; ?>"></label>
                            <p class="rating-like"><?php echo $value_inner['rating_l']; ?></p>
                        </div>
                        <div class="rate-down rate-block checkbox-ajax" data-url="/dislike-reply">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <input
                                type="checkbox" <?php if ($this->reply->isReplyRated($value_inner['id_reply'], $this->getUser()['id_user']) && $this->reply->isReplyRated($value_inner['id_reply'], $this->getUser()['id_user'])['parameter'] == 'D') { echo 'checked';} ?>
                                id="d_<?php echo $value_inner['id_reply']; ?>" name="n_<?php echo $value_inner['id_reply']; ?>" data-id="<?php echo $value_inner['id_reply']; ?>">
                            <label for="d_<?php echo $value_inner['id_reply']; ?>"></label>
                            <p class="rating-dislike"><?php echo $value_inner['rating_d']; ?></p>
                        </div>
                        <div class="rate-reply">Ответить</div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="question-reply reply content-block">
    <div class="reply__wrapper container">
        <form class="reply__box box" data-url="/add-reply">
            <div class="box__avatar">
                <div class="img-cage"><img src="/uploads/img/<?php echo $this->getUser()['avatar']; ?>" alt=""></div>
            </div>
            <div class="box__text">
                <input type="hidden" name="question_id" value="<?php echo $question['id_question']; ?>" required>
                <input type="text" name="text" placeholder="Введите ответ">
            </div>
            <button type="submit" class="btn">Отправить ответ</button>
        </form>
    </div>
</div>
<!-- <div class="question-replies replies content-block">
                <div class="replies__wrapper container">
                  <div class="replies__title h3"><?php echo count($this->question->getReplies()); ?> ответа</div>
                  <div class="replies__items">
                    <?php foreach ($this->question->getReplies() as $key => $value) { ?>
                    <div class="replies__item item">
                      <div class="item__row">
                        <div class="item__col item__col-info">
                          <div class="item__upper">
                            <div class="item__author">
                              <div class="item__author-image"><img src="/uploads/img/<?php echo $value['avatar']; ?>" alt=""></div>
                              <div class="item__author-name">@<?php echo $value['username']; ?></div>
                            </div>
                            <div class="item__date"><?php echo $value['created_at']; ?></div>
                          </div>
                          <div class="item__text"><?php echo $value['text']; ?></div>
                        </div>
                        <div class="item__col item__col-rate rate">
                          <div class="rate__btns checkboxes-filled">
                            <div class="rate__btn checkbox-ajax checkbox" data-url="/like-reply">
                              <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                              <input type="radio" id="l_<?php echo $value['id_reply']; ?>" name="n_<?php echo $value['id_reply']; ?>" data-id="<?php echo $value['id_reply']; ?>">
                              <label for="l_<?php echo $value['id_reply']; ?>">
                                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M6.6167 10L10.6167 1C11.4123 1 12.1754 1.31607 12.738 1.87868C13.3006 2.44129 13.6167 3.20435 13.6167 4V8H19.2767C19.5666 7.99672 19.8538 8.0565 20.1183 8.17522C20.3828 8.29393 20.6183 8.46873 20.8086 8.68751C20.9988 8.90629 21.1392 9.16382 21.22 9.44225C21.3009 9.72068 21.3202 10.0134 21.2767 10.3L19.8967 19.3C19.8244 19.7769 19.5821 20.2116 19.2146 20.524C18.8471 20.8364 18.379 21.0055 17.8967 21H6.6167M6.6167 10V21M6.6167 10H3.6167C3.08627 10 2.57756 10.2107 2.20249 10.5858C1.82741 10.9609 1.6167 11.4696 1.6167 12V19C1.6167 19.5304 1.82741 20.0391 2.20249 20.4142C2.57756 20.7893 3.08627 21 3.6167 21H6.6167" stroke="#DDDDDD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                              </label>
                            </div>
                            <div class="rate__btn checkbox-ajax checkbox" data-url="/dislike-reply">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <input type="radio" id="d_<?php echo $value['id_reply']; ?>" name="n_<?php echo $value['id_reply']; ?>" data-id="<?php echo $value['id_reply']; ?>">
                              <label for="d_<?php echo $value['id_reply']; ?>">
                                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M16.3833 12.0004L12.3833 21.0004C11.5877 21.0004 10.8246 20.6843 10.262 20.1217C9.6994 19.5591 9.38333 18.796 9.38333 18.0004V14.0004H3.72333C3.43342 14.0036 3.14627 13.9439 2.88176 13.8251C2.61725 13.7064 2.38172 13.5316 2.19147 13.3128C2.00123 13.0941 1.86083 12.8365 1.77999 12.5581C1.69916 12.2797 1.67982 11.987 1.72333 11.7004L3.10333 2.70036C3.17565 2.22346 3.4179 1.78875 3.78543 1.47636C4.15295 1.16396 4.621 0.994909 5.10333 1.00036H16.3833M16.3833 12.0004V1.00036M16.3833 12.0004H19.0533C19.6193 12.0104 20.1692 11.8122 20.5987 11.4435C21.0283 11.0749 21.3075 10.5613 21.3833 10.0004V3.00036C21.3075 2.43942 21.0283 1.92586 20.5987 1.55718C20.1692 1.1885 19.6193 0.990352 19.0533 1.00036H16.3833" stroke="#DDDDDD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                              </label>
                            </div>
                          </div>
                          <div class="rate__num"><?php echo $value['rating']; ?></div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div> -->
<!-- <div class="question-reply reply content-block">
                <div class="reply__wrapper container">
                  <div class="reply__title h3">Ваш ответ</div>
                  <form class="reply__box box" data-url="/add-reply">
                    <div class="box__wrapper">
                        <input type="hidden" name="question_id" value="<?php echo $question['id_question']; ?>" required>
                        <textarea rows="10" name="text"></textarea>
                        <div class="inc"><p></p></div>
                    </div>
                    <div class="box__btn">
                      <button type="submit" class="btn">Отправить ответ</button>
                      <p>Нажимая на “Отправить ответ”, вы соглагаетесь с правилами отправки сообщений на форумах.</p>
                    </div>
                  </form>
                </div>
              </div> --> <?php
   require 'views/chunk/footer.php';
?>