<?php
   require 'views/chunk/header.php';
?>
<link rel="stylesheet" href="/resources/css/templates/project.css">
</head>
<div class="g-wrap">
    <div class="outer-bg">
        <header class="header">
            <div class="header__desktop">
                <div class="container">
                    <div class="header__row">
                        <div class="header__col">
                            <div class="header__col-logo">
                                <a href="/"><img src="/resources/images/logo.svg" alt="S&C"></a>
                            </div>
                        </div>
                        <div class="header__col">
                            <div class="header__col-contact">
                                <a href="/contact" class="btn-main">Start a project</a>
                            </div>
                            <div class="header__col-burger">
                                <div class="btn-round"></div>
                                <div class="burger-menu">
                                    <div class="burger-wrap container">
                                        <div class="burger-menu__buttons">
                                            <div class="burger-menu__buttons-contact">
                                                <a href="/contact" class="btn-transparent">Start a project</a>
                                            </div>
                                            <div class="burger-menu__buttons-close">
                                                <div class="btn-round-transparent"></div>
                                            </div>
                                            <div class="burger-menu__buttons-theme">
                                                <div class="btn-round-transparent toggle-theme"></div>
                                            </div>
                                        </div>
                                        <div class="burger-menu__links">
                                            <div class="burger-menu__link">
                                                <a href="/portfolio">Work</a>
                                            </div>
                                            <div class="burger-menu__link">
                                                <a href="/#services-anchor">Services</a>
                                            </div>
                                            <div class="burger-menu__link">
                                                <a href="/">About</a>
                                            </div>
                                            <div class="burger-menu__link">
                                                <a href="/">Blog</a>
                                            </div>
                                            <div class="burger-menu__link">
                                                <a href="/search">Search</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header__col-theme">
                                <div class="btn-round toggle-theme"></div>
                            </div>
                            <div class="lang-wrap">
                                <div class="header__col-lang">
                                    <div class="btn-wrap show header__col-lang-selected">
                                        <div class="btn-round" data-google-lang="en">EN</div>
                                    </div>
                                    <div class="btn-wrap">
                                        <div class="btn-round" data-google-lang="ru">RU</div>
                                    </div>
                                    <div class="btn-wrap">
                                        <div class="btn-round" data-google-lang="pl">PL</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="g-main" style="padding-top: 117px;">
            <div class="container">
                <div class="g-content">
                    <div class="banner">
                        <div class="banner__wrapper">
                            <div class="banner__row">
                                <div class="banner__col">
                                    <div class="banner__title h2"><?php echo $this->project->getName(); ?></div>
                                    <div class="banner__form">
                                        <form class="form" method="post" action="/like.php">
                                            <div class="banner__likes">
                                                <div class="likes-count"><?php echo $this->project->getLikes(); ?></div> <?php
                                                $cookieName = 'liked_project_' . $this->project->getId() . '_' . str_ireplace('.', '_', $_SERVER['REMOTE_ADDR']);
                                                
                                                if (isset($_COOKIE[$cookieName])) {
                                                    $imageSrc = 'like-icon-fill.svg';
                                                } else {
                                                    $imageSrc = 'like-icon-hover.svg';
                                                }
                                                ?> <img class="likes-image"
                                                    src="/resources/images/<?php echo $imageSrc; ?>" alt="Like">
                                                <input type="hidden" name="projectId"
                                                    value="<?php echo $this->project->getId(); ?>">
                                                <input type="hidden" name="likesCount"
                                                    value="<?php echo $this->project->getLikes(); ?>">
                                                <button type="submit" name="edit-likes"></button>
                                            </div>
                                        </form>
                                    </div>
                                    <script>
                                    $(".banner__form form").submit(function(e) {
                                        e.preventDefault();
                                        let th = $(this);
                                        $.ajax({
                                            url: "../like.php",
                                            type: "POST",
                                            data: th.serialize(),
                                            success: function(e) {
                                                let field = document.querySelector(".likes-count");
                                                let image = document.querySelector(".likes-image");
                                                image.src = (field.innerHTML > e) ?
                                                    "/resources/images/like-icon-hover.svg" :
                                                    "/resources/images/like-icon-fill.svg";
                                                field.innerHTML = e;
                                            },
                                            error: function() {
                                                alert("message was not sent");
                                            }
                                        });
                                    });
                                    </script>
                                </div>
                                <div class="banner__col"> <?php
                                        $text = $this->project->getDesc();
                                        $half = strlen($text) / 2;
                                        $first_part = substr($text, 0, strpos($text, '.', $half) + 1);
                                        $second_part = substr($text, strpos($text, '.', $half) + 1);
                                    ?> <div class="col-part"><?php echo $first_part; ?></div>
                                    <div class="col-part"><?php echo $second_part; ?></div>
                                </div>
                            </div>
                            <div class="banner__row">
                                <div class="banner__col">
                                    <div class="banner__col-item">
                                        <div class="item-title">Delivery date</div>
                                        <div class="item-subtitle"><?php echo $this->project->getDeadline(); ?></div>
                                    </div>
                                    <div class="banner__col-item">
                                        <div class="item-title">Time in devemopment</div>
                                        <div class="item-subtitle"><?php echo $this->project->getDevPeriod(); ?></div>
                                    </div>
                                </div>
                                <div class="banner__col">
                                    <div class="banner__col-tags">
                                        <div class="tag-title">Tags</div>
                                        <div class="tags">
                                            <a><?php echo $this->getServiceById($this->project->getServiceId())['name']; ?></a>
                                            <a><?php echo $this->getProjectTypeById($this->project->getTypeId())['name']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="images">
                        <div class="images__wrapper">
                            <div class="images__cards"> <?php
                                    foreach ($this->getProjectImages($this->project->getId()) as $value):
                                ?> <div class="image__card">
                                    <div class="card-wrapper">
                                        <img src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>"
                                            alt="Project image">
                                    </div>
                                    <div class="card-btn">
                                        <img src="/resources/images/arr-portfolio-dark.svg" alt="Open in full size">
                                    </div>
                                </div> <?php endforeach; ?> <div class="images__popup">
                                    <div class="popup">
                                        <div class="popup__close">
                                            <div class="btn-transparent">Close</div>
                                        </div>
                                        <div class="popup__wrapper">
                                            <div class="popup__images"> <?php
                                                    foreach ($this->getProjectImages($this->project->getId()) as $value):
                                                ?> <div class="popup__image">
                                                    <img
                                                        src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>">
                                                </div> <?php endforeach; ?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-info">
                        <div class="text-info__wrapper">
                            <div class="text-info__desc"> <?php echo $this->project->getTextHtml(); ?> </div>
                        </div>
                    </div>
                    <div class="team">
                        <div class="team__wrapper">
                            <div class="team__title h4">Team</div>
                            <div class="team__cards"> <?php
                                    foreach ($this->getProjectTeam($this->project->getId()) as $value):
                                        $member = $this->project->getById('Team', $value['member_id']);
                                ?> <div class="team__card">
                                    <div class="card">
                                        <div class="card__image">
                                            <img src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $member['image_id'])['imageSrc']; ?>"
                                                alt="Team member">
                                        </div>
                                        <div class="card__text">
                                            <div class="card__name"><?php echo $member['name']; ?></div>
                                            <div class="card__position"><?php echo $member['position']; ?></div>
                                        </div>
                                    </div>
                                </div> <?php endforeach; ?> </div>
                        </div>
                    </div>
                    <div class="stack">
                        <div class="stack__wrapper">
                            <div class="stack__title h4">Technology stack</div>
                            <div class="stack__cards"> <?php
                                    foreach ($this->getProjectTechnologies($this->project->getId()) as $value):
                                        $technology = $this->project->getById('TechnologiesList', $value['technology_id']);
                                ?> <div class="stack__card">
                                    <div class="card">
                                        <div class="card__image">
                                            <img src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $technology['image_id'])['imageSrc']; ?>"
                                                alt="Technology">
                                        </div>
                                    </div>
                                </div> <?php endforeach; ?> </div>
                        </div>
                    </div>
                    <div class="contact-button">
                        <div class="contact-button__wrapper">
                            <div class="contact-button__title h3">Наve a project? Let's talk</div>
                            <div class="contact-button__button">
                                <span>Contact</span>
                                <div class="circle-wrap">
                                    <div class="empty-circle"></div>
                                    <div class="full-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <div class="footer__wrapper">
                        <div class="footer__row">
                            <div class="footer__col">
                                <div class="footer__col-logo"></div>
                                <span>Have a project? Let's talk</span>
                                <div class="footer__col-socials">
                                    <a class="instagram-link" href="https://instagram.com/frenron"></a>
                                    <a class="whatsapp-link"
                                        href="https://api.whatsapp.com/message/X3BUVATRZN4XB1?autoload=1&app_absent=0"></a>
                                    <a class="telegram-link" href="https://t.me/bosssncgroup"></a>
                                    <a class="email-link" href="mailto:notfrenron@gmail.com"></a>
                                </div>
                            </div>
                            <div class="footer__col">
                                <div class="footer__col-contact">
                                    <div class="footer__col-title">Get in touch</div>
                                    <a href="tel:+48537567269">+48 537 567 269</a><br>
                                    <a href="tel:+375299184108">+375 299 184 108</a><br>
                                    <a href="mailto:notfrenron@gmail.com">notfrenron@gmail.com</a>
                                </div>
                                <div class="footer__col-menu">
                                    <div class="footer__col-title">Get in touch</div>
                                    <div class="menu">
                                        <div class="menu__item">
                                            <a href="#">Portfolio</a>
                                        </div>
                                        <div class="menu__item"><a href="#services-anchor">Services</a></div>
                                        <div class="menu__item"><a href="#team-anchor">Our Team</a></div>
                                        <div class="menu__item"><a href="#">Contacts</a></div>
                                    </div>
                                    <span>IP S&C Group 2023</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
<script src="/resources/js/project.js"></script> <?php
   require 'views/chunk/footer.php';
   ?>