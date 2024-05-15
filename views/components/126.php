                <?php
                function filterQuestions($data, $selectedTechIds, $selectedLevelIds) {
                  if (empty($selectedTechIds[0]) && empty($selectedLevelIds[0])) {
                      return array_intersect_key($data, array_unique(array_column($data, 'question_id')));
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
                  
                  return array_intersect_key($filteredData, array_unique(array_column($filteredData, 'question_id')));
                }
    
                foreach (filterQuestions($data, $checks['filter_techs'], $checks['filter_levels']) as $key => $value) {
                  ?>
                  <div class="list__item questions-item item">
                      <div class="item__row">
                        <div class="item__col item__col-left">
                          <div class="text-wrap">
                            <a href="<?php echo $value->subtopic_alias . '/' . $value->alias; ?>" class="item__title"><?php echo $value->name; ?></a>
                            <div class="item__tags">
                              <?php foreach ($value->tags as $inner_key => $inner_value) { ?>
                                <a class="item__tag"><?php echo $inner_value->name;?></a>
                              <?php } ?>
                              <a class="item__tag-level"><?php echo $value->level_name;?></a>
                            </div>
                          </div>
                          <div class="item__details">? ответа</div>
                        </div>
                        <div class="item__col item__col-right">
                          <div class="text-wrap">
                            <div class="item__date"><?php echo $value->created_at; ?></div>
                            <div class="item__author">
                              <div class="img-cage">
                                <img src="/uploads/img/<?php echo $value->avatar; ?>" alt=""></div>
                              <p>@<?php echo $value->username; ?>, <span><?php echo $value->rating; ?> опыта</span></p>
                            </div>
                          </div>
                          <div class="item__favourite favourite-btn"></div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
