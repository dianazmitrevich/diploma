                <?php
                  function filterVacancies($data, $selected_positions, $selected_companies) {
                    if (empty($selected_positions[0]) && empty($selected_companies[0])) {
                        return $data;
                    }


                    return array_filter($data, function($row) use ($selected_positions, $selected_companies) {
                        $inPositions = in_array($row->vacancy_id, $selected_positions);
                        $inCompanies = in_array($row->id_company, $selected_companies);

                        if (!empty($selected_positions[0]) && !empty($selected_companies[0])) {
                            return $inPositions && $inCompanies;
                        }

                        return $inPositions || $inCompanies;
                    });
                  }

                if (count(filterVacancies($data, $checks['vacancies_positions'], $checks['vacancies_companies'])) < 1) { ?>
                <div class="empty-block empty">
                    <div class="empty__wrapper container">
                    <div class="empty__row">
                        <div class="empty__col empty__col-image">
                        <div class="image-cage"><img src="/resources/img/empty.svg" alt=""></div>
                        </div>
                        <div class="empty__col">
                        <div class="empty__title">Пусто!</div>
                        <div class="empty__subtitle">При данных параметрах фильтрации вакансией не найдено</div>
                        </div>
                    </div>
                    </div>
                </div>
                <?php } else {
                foreach (filterVacancies($data, $checks['vacancies_positions'], $checks['vacancies_companies']) as $key => $value) {
                 ?>
                                      <div class="list__item vacancies-item item">
                                        <div class="item__row">
                                            <div class="item__col item__col-left">
                                                <div class="item__title"><?php echo $value->vacancy_name; ?></div>
                                                <div class="item__tags">
                                                    <div class="item__tag"><?php echo $value->vacancy_level; ?></div>
                                                    <div class="item__tag item__tag-company"><?php echo $value->vacancy_company; ?></div>
                                                    <div class="item__tag item__tag-inq"><?php echo $value->responcesCount; ?> откликов</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item__row item__row-bottom">
                                            <div class="item__text"><?php echo $value->vacancy_text; ?></div>
                                            <?php if ($user_role !== 'R' && $user_role !== 'A') { ?>
                                            <form <?php if (!in_array($user_id, $value->vacanced_ids)) { ?>data-url="/vacancy-response"<?php } ?>>
                                              <input type="hidden" name="user_id" value="<?php ?>">
                                              <input type="hidden" name="vacancy_id" value="<?php echo $value->id_vacancy; ?>">
                                              <?php if (!in_array($user_id, $value->vacanced_ids)) { ?>
                                              <button type="submit" class="btn">Откликнуться</button>
                                              <?php } else { ?>
                                              <button class="btn btn-green">Вы откликнулись</button>
                                              <?php } ?>
                                            </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                  <?php } } ?>
