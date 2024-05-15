<?php
   require 'chunk/header.php';
?>

            <div class="bonnet">
                <div class="bonnet__wrapper container">
                  <div class="bonnet__line">Главная / Темы</div>
                  <div class="bonnet__title h2">Темы</div>
                </div>
              </div>
              <div class="themes-filter filter">
                <div class="filter__wrapper container">
                  <div class="filter__boxes checkboxes-ajax" data-id="123" data-url="/ajax/api.php" data-element="125" data-api="main_topics">
                    <input type="hidden" name="main_topics" value="<?php echo $this->getTopicsIds(); ?>">
                    <?php foreach($this->topic->readMainTopics() as $key => $value) { ?>
                      <?php if ($this->topic->readSubTopics($value["id_topic"])) { ?>
                      <div class="checkbox">
                        <input type="checkbox" checked name="" id="c_<?php echo $value['id_topic']; ?>" data-id="<?php echo $value['id_topic']; ?>">
                        <label for="c_<?php echo $value['id_topic']; ?>"><?php echo $value['name'] ?></label>
                      </div>
                    <?php }} ?>
                  </div>
                </div>
              </div>
              <div class="theme-list theme content-block">
                <div class="theme__wrapper container">
                  <div id="123">
                    <?php foreach($this->topic->readMainTopics() as $key => $value) { 
                        if ($this->topic->readSubTopics($value['id_topic'])) {  
                    ?>
                    <div class="theme__single content-section">
                      <div class="theme__title h3"><?php echo $value['name'] ?></div>
                      <div class="theme__items">
                        <?php foreach($this->topic->readSubTopics($value['id_topic']) as $key_inner => $value_inner) { ?>
                        <a href="/topics/<?php echo $value_inner['alias'] . '?main_topic=' . $value['id_topic']; ?>" class="theme__item theme-item item"><?php echo $value_inner['name'] ?></a>
                        <?php } ?>
                      </div>
                    </div>
                      <?php }} ?>
                  </div>
                  <div class="theme__more">
                    <p>Не нашли подходящую тему? Тогда можно создать новую!</p>
                    <div class="btn btn-ajax" data-url="/ajax/popup.php" data-id="438" data-api="main_topics" data-user="<?php echo $this->getAuth(); ?>">Добавить тему</div>
                  </div>
                </div>
              </div>

<?php
   require 'chunk/footer.php';
?>