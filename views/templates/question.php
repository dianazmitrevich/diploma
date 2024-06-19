<title><?php echo $question['name'] . ' – Hackora'; ?></title>
<?php
   require 'views/chunk/header.php';
?>
<div class="bonnet">
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
                        <?php foreach ($this->question->getTechnologiesList() as $key => $value) { ?>
                            <a class="item__tag"><?php echo $value['name']; ?></a>
                        <?php } ?>
                            <a class="item__tag-level"><?php echo $this->level->findById($this->question->findById($question['id_question'])['level_id'])['name']; ?></a>
                            <?php if ($this->question->isValidated($question['id_question'])) {?><a class="item__tag-validated">Подтвержден</a><?php } ?>
                            <?php if ($this->user->findById($question['author_id'])['role'] === 'R') { ?><a class="item__tag-recruiter">Вопрос рекрутера</a><?php } ?>
                        </div>
                    </div>
                </div>
                <div class="item__col item__col-right">
                    <div class="text-wrap">
                        <div class="item__author">
                            <div class="img-cage"><img src="/uploads/img/<?php echo $this->user->findById($question['author_id'])['avatar']; ?>" alt=""></div>
                            <?php if ($this->user->findById($question['author_id'])['role'] === 'R') { ?>
                                <p><?php echo $this->user->findById($question['author_id'])['username']; ?>
                                    <span class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->formatDate($question['created_at']); ?></span>
                                </p>
                                <?php } else { ?>
                                <p>@<?php echo $this->user->findById($question['author_id'])['username']; ?>,
                                    <span><?php echo $this->user->findById($question['author_id'])['rating']; ?> опыта</span>
                                    <span class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->formatDate($question['created_at']); ?></span>
                                </p>
                                <?php } ?>
                        </div>
                    </div>
                    <?php if ($this->getAuth() && $this->getUser()['role'] !== 'A') { ?>
                        <div class="item__favourite favourite-btn checkbox-ajax" data-url="/edit-favourite">
                        <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <div class="checkbox checkbox-fav anim-btn">
                                <input <?php if ($this->question->isFavourite($question['id_question'], $this->getUser()['id_user'])) echo 'checked'; ?> type="checkbox"
                                    id="fav_<?php echo $question['id_question']; ?>" data-id="<?php echo $question['id_question']; ?>">
                                <label for="fav_<?php echo $question['id_question']; ?>"></label>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="single__desc"><?php echo $question['description']; ?></div>
        <?php if ($this->getAuth() && $this->getUser()['role'] !== 'R' && $this->getUser()['role'] !== 'A') { ?>
        <div class="single__checkbox checkbox-ajax" data-url="/edit-completed">
            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
            <div class="checkbox">
                <input <?php if ($this->question->getCompleted()) echo 'checked'; ?> type="checkbox"
                    id="comp_<?php echo $question['id_question']; ?>" data-id="<?php echo $question['id_question']; ?>">
                <label for="comp_<?php echo $question['id_question']; ?>">отметить как пройденный</label>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<div class="question-replies replies content-block p-0">
    <div class="replies__wrapper container">
        <div class="replies__title">
            <div class="wrap">
                <div class="h3"><?php echo count($this->question->getReplies()); ?> ответа</div>
            </div>
        </div>
        <?php if (!$this->question->getReplies()) { ?>
            <div class="empty-block empty">
                <div class="empty__wrapper container">
                  <div class="empty__row">
                    <div class="empty__col empty__col-image">
                      <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                    </div>
                    <div class="empty__col">
                      <div class="empty__title">Пусто!</div>
                      <div class="empty__subtitle">Пока еще никто не добавил ответ к вопросу. <?php if ($this->getUser()['role'] !== 'R') { echo 'Хотите добавить свой ответ? 😁'; } else { echo 'Скоро кто-то ответит!'; } ?></div>
                    </div>
                  </div>
                </div>
              </div>
        <?php } else { ?>
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
                        <div class="rate-up rate-block <?php if ($this->getAuth()) { echo 'checkbox-ajax'; } ?>" data-url="<?php if ($this->getAuth()) { echo '/like-reply'; } ?>">
                            <input type="hidden" value="<?php if ($this->getAuth()) { echo $this->getUser()['id_user']; } ?>">
                            <input
                                type="checkbox" <?php if (!$this->getAuth()) { echo 'disabled'; } ?>
                                <?php if ($this->getAuth() && $this->reply->isReplyRated($value['id_reply'], $this->getUser()['id_user']) && $this->reply->isReplyRated($value['id_reply'], $this->getUser()['id_user'])['parameter'] == 'L') { echo 'checked';} ?>
                                id="l_<?php echo $value['id_reply']; ?>"
                                name="n_<?php echo $value['id_reply']; ?>"
                                data-id="<?php echo $value['id_reply']; ?>"
                            >
                            <label for="l_<?php echo $value['id_reply']; ?>"></label>
                            <p class="rating-like"><?php echo $value['rating_l']; ?></p>
                        </div>
                        <div class="rate-down rate-block <?php if ($this->getAuth()) { echo 'checkbox-ajax'; } ?>" data-url="<?php if ($this->getAuth()) { echo '/dislike-reply'; } ?>">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <input
                                type="checkbox" <?php if (!$this->getAuth()) { echo 'disabled'; } ?>
                                <?php if ($this->getAuth() && $this->reply->isReplyRated($value['id_reply'], $this->getUser()['id_user']) && $this->reply->isReplyRated($value['id_reply'], $this->getUser()['id_user'])['parameter'] == 'D') { echo 'checked';} ?>
                                id="d_<?php echo $value['id_reply']; ?>"
                                name="n_<?php echo $value['id_reply']; ?>"
                                data-id="<?php echo $value['id_reply']; ?>"
                            >
                            <label for="d_<?php echo $value['id_reply']; ?>"></label>
                            <p class="rating-dislike"><?php echo $value['rating_d']; ?></p>
                        </div>
                        <?php if($this->getAuth()) { ?>
                        <div class="rate-reply">Ответить</div>
                        <?php } ?>
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
                        <div class="rate-up rate-block <?php if ($this->getAuth()) { echo 'checkbox-ajax'; } ?>" data-url="<?php if ($this->getAuth()) { echo '/like-reply'; } ?>">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <input
                                type="checkbox" <?php if (!$this->getAuth()) { echo 'disabled'; } ?>
                                <?php if ($this->getAuth() && $this->reply->isReplyRated($value_inner['id_reply'], $this->getUser()['id_user']) && $this->reply->isReplyRated($value_inner['id_reply'], $this->getUser()['id_user'])['parameter'] == 'L') { echo 'checked';} ?>
                                id="l_<?php echo $value_inner['id_reply']; ?>" name="n_<?php echo $value_inner['id_reply']; ?>" data-id="<?php echo $value_inner['id_reply']; ?>">
                            <label for="l_<?php echo $value_inner['id_reply']; ?>"></label>
                            <p class="rating-like"><?php echo $value_inner['rating_l']; ?></p>
                        </div>
                        <div class="rate-down rate-block <?php if ($this->getAuth()) { echo 'checkbox-ajax'; } ?>" data-url="<?php if ($this->getAuth()) { echo '/dislike-reply'; } ?>">
                            <input type="hidden" value="<?php echo $this->getUser()['id_user'];?>">
                            <input
                                type="checkbox" <?php if (!$this->getAuth()) { echo 'disabled'; } ?>
                                <?php if ($this->getAuth() && $this->reply->isReplyRated($value_inner['id_reply'], $this->getUser()['id_user']) && $this->reply->isReplyRated($value_inner['id_reply'], $this->getUser()['id_user'])['parameter'] == 'D') { echo 'checked';} ?>
                                id="d_<?php echo $value_inner['id_reply']; ?>" name="n_<?php echo $value_inner['id_reply']; ?>" data-id="<?php echo $value_inner['id_reply']; ?>">
                            <label for="d_<?php echo $value_inner['id_reply']; ?>"></label>
                            <p class="rating-dislike"><?php echo $value_inner['rating_d']; ?></p>
                        </div>
                        <?php if($this->getAuth()) { ?>
                        <div class="rate-reply">Ответить</div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php if($this->getAuth() && $this->getUser()['role'] !== 'R' && $this->getUser()['role'] !== 'A') { ?>
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
            <button type="submit" class="btn box__btn">Отправить ответ</button>
        </form>
    </div>
</div>
<?php } ?>
<?php
   require 'views/chunk/footer.php';
?>