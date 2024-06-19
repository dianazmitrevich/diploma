                    <?php
                    // var_dump($data);
                    // var_dump($item);
                    $position = $data[0][0]->position_name;
                    
                    function filterData($data, $item) {
                        return array_filter($data, function($obj) use ($item) {
                            return $obj->id_topic == $item;
                        });
                    }

                    $data_filtered = filterData($data[0], $item);
                    ?>
                    <div class="popup">
                        <div class="popup-wrap show"></div>
                        <div class="popup__wrap show">
                            <div class="wrap">
                                <div class="popup__row popup__row-upper">
                                    <div class="popup__title h2"><?php echo $position; ?></div>
                                    <div class="popup__btn remove-btn"></div>
                                </div>
                                <div class="popup__inner inner">
                                    <div class="inner__positions">
                                        <?php foreach ($data_filtered as $key => $value) { ?>
                                        <div class="inner__positions-item item">
                                            <div class="item__image">
                                                <div class="img-cage"><img src="/uploads/img/<?php echo $value->user_avatar; ?>" alt=""></div>
                                            </div>
                                            <div class="item__username">@<?php echo $value->user_login; ?></div>
                                            <div class="item__name"><?php echo $value->user_name; ?></div>
                                            <div class="item__mail"><?php echo $value->user_email; ?></div>
                                            <div class="item__rating">Рейтинг – <?php echo $value->user_rating; ?></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>