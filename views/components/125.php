                  <?php 
                    foreach($data as $key => $value) {
                    if (in_array($value->id_topic, $checks['main_topics'])) {
                      if ($value->subtopics) {
                  ?>
                  <div class="theme__single content-section">
                    <div class="theme__title h3"><?php echo $value->name; ?></div>
                    <div class="theme__items">
                      <?php foreach($value->subtopics as $key_inner => $value_inner) { ?>
                        <a href="/topics/<?php echo $value_inner->alias . '?main_topic=' . $value->id_topic; ?>" class="theme__item theme-item item">
                        <?php echo $value_inner->name; ?>
                          <span><?php echo $value_inner->questions_count; ?> вопроса</span>
                          <?php if ($value_inner->is_validated) { ?><p class="validated"></p><?php } ?>
                        </a>
                      <?php } ?>
                    </div>
                  </div>
                  <?php }}} ?>