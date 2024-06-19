                <?php
                function filterQuestions($data, $selectedTechIds, $selectedLevelIds, $topic_id) {
                  function filterArrayByTopicId($array, $topic_id) {
                    return array_filter($array, function($item) use ($topic_id) {
                          return $item->id_topic == $topic_id;
                        });
                  }

                  if (empty($selectedTechIds[0]) && empty($selectedLevelIds[0])) {
                      return filterArrayByTopicId(array_intersect_key($data, array_unique(array_column($data, 'question_id'))), $topic_id);
                  }

                  $filteredData = [];

                  foreach ($data as $row) {
                      $levelId = $row->id_level;
                      $tags = $row->tags;

                      if (!empty($selectedLevelIds[0]) && !in_array($levelId, $selectedLevelIds)) {
                          continue;
                      }

                      if (!empty($selectedTechIds[0])) {
                          $questionTechIds = array_map(function($tag) { return $tag->id_tech; }, $tags);
                          if (count(array_intersect($questionTechIds, $selectedTechIds)) != count($selectedTechIds)) {
                              continue;
                          }
                      }

                      $filteredData[] = $row;
                  }
                  
                  return filterArrayByTopicId(array_intersect_key($filteredData, array_unique(array_column($filteredData, 'question_id'))), $topic_id);
                }
    
                foreach (filterQuestions($data, $checks['filter_techs'], $checks['filter_levels'], $topic_id) as $key => $value) {
                  ?>
                <div class="list__item questions-item item">
                <div class="item__row">
                    <div class="item__col item__col-left">
                        <div class="text-wrap">
                            <div class="item__details"><?php echo $value->replies_count; ?> ответа</div>
                            <a href="<?php echo $value->subtopic_alias . '/' . $value->alias; ?>"
                                class="item__title"><?php echo $value->name; ?></a>
                            <div class="item__tags">
                              <?php foreach ($value->tags as $inner_key => $inner_value) { ?>
                                <a class="item__tag"><?php echo $inner_value->name;?></a>
                              <?php } ?>
                              <a class="item__tag-level"><?php echo $value->level_name;?></a>
                              <?php if ($value->is_validated) {?><a class="item__tag-validated">Подтвержден</a><?php } ?>
                              <?php if ($value->role === 'R') { ?><a class="item__tag-recruiter">Вопрос рекрутера</a><?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="item__col item__col-right">
                        <div class="text-wrap">
                            <div class="item__author">
                                <div class="img-cage">
                                    <img src="/uploads/img/<?php echo $value->avatar; ?>"
                                        alt="">
                                </div>
                                <?php if ($value->role === 'R') { ?>
                                <p><?php echo $value->username; ?><span class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->created_at; ?></span>
                                </p>
                                <?php } else { ?>
                                <p>@<?php echo $value->username; ?>,
                                    <span><?php echo $value->rating; ?> опыта</span>
                                    <span class="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->created_at; ?></span>
                                </p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ($user_id && $user_role !== 'A') { ?>
                        <div class="item__favourite favourite-btn checkbox-ajax" data-url="/edit-favourite">
                        <input type="hidden" value="<?php echo $user_id;?>">
                            <div class="checkbox checkbox-fav">
                                <input <?php if (in_array($user_id, $value->faved_by)) echo 'checked'; ?> type="checkbox"
                                    id="fav_<?php echo $value->question_id; ?>" data-id="<?php echo $value->question_id; ?>">
                                <label for="fav_<?php echo $value->question_id; ?>"></label>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
                <?php } ?>
