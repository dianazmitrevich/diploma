                  <?php
                    $filter_tech = [];
                    $filter_levels = [];
                    foreach($data as $key => $value) {
                      if (in_array($value->technology_id, $checks['filter_techs'])) {
                        $filter_tech[] = $value->question_id;
                      }

                      if (in_array($value->id_level, $checks['filter_levels'])) {
                        $filter_levels[] = $value->question_id;
                      }
                    }

                    $intersect = array_intersect($filter_tech, $filter_levels);
                    $intersect = array_unique($intersect);
                  ?>
                  <?php foreach ($data as $key => $value) {
                    if (in_array($value->question_id, $intersect)) {
                      $keyword = array_search($value->question_id, $intersect);
                      if ($keyword !== false) {
                          unset($intersect[$keyword]);
                      }
                  ?>
                  <div class="list__item questions-item item">
                      <div class="item__row">
                        <div class="item__col item__col-left">
                          <div class="text-wrap">
                            <div class="item__title"><?php echo $value->name; ?></div>
                            <div class="item__tags">
                              <?php foreach ($value->tags as $inner_key => $inner_value) { ?>
                                <a class="item__tag"><?php echo $inner_value->name;?></a>
                              <?php } ?>
                              <a class="item__tag-level"><?php echo $value->level_name;?></a>
                            </div>
                          </div>
                          <div class="item__details">2 голоса&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3 ответа</div>
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
                  <?php }} ?>
