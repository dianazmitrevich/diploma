<?php
   require 'views/chunk/header.php';
?>
<link rel="stylesheet" href="/resources/css/admin.css">
</head>

<body>
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
                                <div class="header__col-theme">
                                    <div class="btn-round toggle-theme"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="g-main" style="padding-top: 117px;">
                <div class="container">
                    <div class="g-content">
                        <div class="hero">
                            <div class="hero__wrapper">
                                <div class="hero__title h2">Adding new item to <?php echo $_POST['table']; ?></div>
                                <div class="hero__tabs"> <?php
                                        $display = ['Projects' => '', 'Services' => '', 'ProjectTypes' => '', 'Team' => '', 'TechnologiesList' => '', 'Medialibrary' => ''];
                                        $display[$_POST['table']] = 'style="display: block;"';
                                    ?> <form class="control-buttons" action="/adm1n/add" method="post">
                                        <button name="back" type="submit" class="btn-main mb-0">Back to panel</button>
                                    </form>
                                    <form class="form form-add" action="/adm1n/add" method="post"
                                        <?php echo $display['Projects']; ?>> <?php
                                            if ($display['Projects']) {
                                        ?> <div class="hero__tab">
                                            <div class="tab show pos-rel">
                                                <table class="tab__table table-custom">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 30%;">Field</th>
                                                            <th>Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>
                                                                <input type="text" name="name" required
                                                                    pattern="^[a-zA-Z0-9\s_-,\.]{3,50}$">
                                                                <label for="name">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>
                                                            <td>
                                                                <input type="text" name="description" required>
                                                                <label for="description">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Deadline</td>
                                                            <td>
                                                                <input type="text" name="deadline" required>
                                                                <label for="deadline">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Time in devemopment</td>
                                                            <td>
                                                                <input type="text" name="devPeriod" required>
                                                                <label for="devPeriod">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Service</td>
                                                            <td>
                                                                <select name="service"> <?php
                                                                        foreach ($this->readTable('Services') as $value):
                                                                    ?> <option value="<?php echo $value['id']; ?>">
                                                                        <?php echo $value['name']; ?> </option>
                                                                    <?php endforeach; ?> </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Project type</td>
                                                            <td>
                                                                <select name="type"> <?php
                                                                        foreach ($this->readTable('ProjectTypes') as $value):
                                                                    ?> <option value="<?php echo $value['id']; ?>">
                                                                        <?php echo $value['name']; ?> </option>
                                                                    <?php endforeach; ?> </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alias</td>
                                                            <td>
                                                                <input type="text" name="alias" required>
                                                                <label for="alias">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Html text</td>
                                                            <td>
                                                                <input type="text" name="textHtml" required>
                                                                <label for="textHtml">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Images (tap to remove)</td>
                                                            <td class="form-images form-images-multiple">
                                                                <div class="btn-text open-medialibrary">Choose from
                                                                    medialibrary</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Preview image</td>
                                                            <td class="form-images form-images-single">
                                                                <div class="btn-text open-medialibrary-single">Choose
                                                                    from medialibrary</div>
                                                                <img class="form-image"
                                                                    src="/controllers/uploads/fill.png">
                                                                <input type="hidden" name="preview" class="form-hidden"
                                                                    value="64">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="hero__tab">
                                            <div class="tab show pos-rel">
                                                <table class="tab__table table-custom">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">Team member</th>
                                                            <th>Name</th>
                                                            <th>Has worked on this project?</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> <?php
                                                            foreach ($this->readTable('Team') as $value):
                                                        ?> <tr>
                                                            <td style="text-align: center;">
                                                                <img
                                                                    src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>">
                                                            </td>
                                                            <td><?php echo $value['name']; ?></td>
                                                            <td>
                                                                <input type="checkbox" name="teamMembers[]"
                                                                    value="<?php echo $value['id']; ?>">
                                                            </td>
                                                        </tr> <?php endforeach; ?> </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="hero__tab">
                                            <div class="tab show pos-rel">
                                                <table class="tab__table table-custom">
                                                    <thead>
                                                        <tr>
                                                            <th>Technology</th>
                                                            <th>Was used in this project?</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> <?php
                                                            foreach ($this->readTable('TechnologiesList') as $value):
                                                        ?> <tr>
                                                            <td>
                                                                <img style="width: 100px;"
                                                                    src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="technologies[]"
                                                                    value="<?php echo $value['id']; ?>">
                                                            </td>
                                                        </tr> <?php endforeach; ?> </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <input type="hidden" name="table" value="Projects">
                                            <button name="add-btn" type="submit" class="btn-main mr2">Add new
                                                item</button>
                                        </div><?php
                                            }
                                        ?>
                                    </form>
                                    <form class="form form-add" action="/adm1n/add" method="post"
                                        <?php echo $display['Services']; ?>> <?php
                                            if ($display['Services']) {
                                        ?> <div class="hero__tab">
                                            <div class="tab show pos-rel">
                                                <table class="tab__table table-custom">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 30%;">Field</th>
                                                            <th>Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>
                                                                <input type="text" name="name"
                                                                    pattern="^[a-zA-Z0-9\s_-,\.]{3,50}$" required>
                                                                <label for="name">*</label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <input type="hidden" name="table" value="Services">
                                            <button name="add-btn" type="submit" class="btn-main mr2">Add new
                                                item</button>
                                        </div> <?php
                                            }
                                        ?>
                                    </form>
                                    <form class="form form-add" action="/adm1n/add" method="post"
                                        <?php echo $display['ProjectTypes']; ?>> <?php
                                            if ($display['ProjectTypes']) {
                                        ?> <div class="hero__tab">
                                            <div class="tab show pos-rel">
                                                <table class="tab__table table-custom">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 30%;">Field</th>
                                                            <th>Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>
                                                                <input type="text" name="name"
                                                                    pattern="^[a-zA-Z0-9\s_-,\.]{3,50}$" required>
                                                                <label for="name">*</label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <input type="hidden" name="table" value="ProjectTypes">
                                            <button name="add-btn" type="submit" class="btn-main mr2">Add new
                                                item</button>
                                        </div> <?php
                                            }
                                        ?>
                                    </form>
                                    <form class="form form-add" action="/adm1n/add" method="post"
                                        enctype="multipart/form-data" <?php echo $display['Team']; ?>> <?php
                                            if ($display['Team']) {
                                        ?> <div class="hero__tab">
                                            <div class="tab show pos-rel">
                                                <table class="tab__table table-custom">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 30%;">Field</th>
                                                            <th>Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>
                                                                <input type="text" name="name"
                                                                    pattern="^[a-zA-Z0-9\s_-,\.]{3,50}$" required>
                                                                <label for="name">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Position</td>
                                                            <td>
                                                                <input type="text" name="position"
                                                                    pattern="^[a-zA-Z0-9\s_-,\.]{3,50}$" required>
                                                                <label for="position">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Preview image</td>
                                                            <td class="form-images form-images-single">
                                                                <div class="btn-text open-medialibrary-single">Choose
                                                                    from medialibrary</div>
                                                                <img class="form-image"
                                                                    src="/controllers/uploads/fill.png">
                                                                <input type="hidden" name="teamImage"
                                                                    class="form-hidden" value="64">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <input type="hidden" name="table" value="Team">
                                            <button name="add-btn" type="submit" class="btn-main mr2">Add new
                                                item</button>
                                        </div> <?php
                                            }
                                        ?>
                                    </form>
                                    <form class="form form-add" action="/adm1n/add" method="post"
                                        <?php echo $display['TechnologiesList']; ?>> <?php
                                            if ($display['TechnologiesList']) {
                                        ?> <div class="hero__tab">
                                            <div class="tab show pos-rel">
                                                <table class="tab__table table-custom">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 30%;">Field</th>
                                                            <th>Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Image</td>
                                                            <td class="form-images form-images-single">
                                                                <div class="btn-text open-medialibrary-single">Choose
                                                                    from medialibrary</div>
                                                                <img class="form-image"
                                                                    src="/controllers/uploads/fill.png">
                                                                <input type="hidden" name="techImage"
                                                                    class="form-hidden" value="64">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <input type="hidden" name="table" value="TechnologiesList">
                                            <button name="add-btn" type="submit" class="btn-main mr2">Add new
                                                item</button>
                                        </div> <?php
                                            }
                                        ?>
                                    </form>
                                </div>
                                <div class="hero__popup hero__popup-multiple">
                                    <div class="popup">
                                        <div class="popup__wrapper">
                                            <div class="popup__close btn-main">Close </div>
                                            <div class="popup__images">
                                                <div class="images-wrap"> <?php
                                                        foreach ($this->readTable('Medialibrary') as $value):
                                                    ?> <div class="images-item">
                                                        <input type="checkbox" class="checkbox-multiple"
                                                            value="<?php echo $value['id']; ?>"
                                                            data-src="<?php echo $value['imageSrc']; ?>">
                                                        <img style="width: 100px"
                                                            src="/controllers/uploads/<?php echo $value['imageSrc']; ?>">
                                                    </div> <?php endforeach; ?> </div>
                                                <div class="btn-main bind-medialibrary"> Bind images </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hero__popup hero__popup-single">
                                    <div class="popup">
                                        <div class="popup__wrapper">
                                            <div class="popup__close btn-main">Close </div>
                                            <div class="popup__images">
                                                <div class="images-wrap"> <?php
                                                        foreach ($this->readTable('Medialibrary') as $value):
                                                    ?> <div class="images-item">
                                                        <input type="radio" class="radio-single"
                                                            name="single-image-radio"
                                                            value="<?php echo $value['id']; ?>"
                                                            data-src="<?php echo $value['imageSrc']; ?>">
                                                        <img style="width: 100px"
                                                            src="/controllers/uploads/<?php echo $value['imageSrc']; ?>">
                                                    </div> <?php endforeach; ?> </div>
                                                <div class="btn-main bind-medialibrary-single"> Bind images </div>
                                            </div>
                                        </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="/resources/js/admin.js"></script> <?php
   require 'views/chunk/footer.php';
?>