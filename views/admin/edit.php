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
                                <div class="hero__title h2">Editing <?php echo $_POST['table'];?> table item</div> <?php
                                    $display = ['Projects' => '', 'Services' => '', 'ProjectTypes' => '', 'Team' => '', 'TechnologiesList' => ''];
                                    $display[$_POST['table']] = 'style="display: block;"';
                                ?> <form class="custom-btn-wrap" action="/adm1n/add" method="post">
                                    <button name="back" type="submit" class="btn-main mb-0">Back to panel</button>
                                </form>
                                <div class="hero__tabs form-edit" <?php echo $display['Projects']; ?>> <?php 
                                        if ($this->project->getId()) { ?> <form class="form" action="/adm1n/edit"
                                        method="post">
                                        <input type="hidden" name="table" value="Projects">
                                        <input type="hidden" name="itemId"
                                            value="<?php echo $this->project->getId(); ?>">
                                        <div class="hero__tab">
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
                                                                    pattern="^[a-zA-Z0-9\s_-]{3,50}$"
                                                                    value="<?php echo $this->project->getName(); ?>">
                                                                <label for="name">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>
                                                            <td>
                                                                <input type="text" name="description"
                                                                    value="<?php echo $this->project->getDesc(); ?>">
                                                                <label for="description">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Deadline</td>
                                                            <td>
                                                                <input type="text" name="deadline"
                                                                    value="<?php echo $this->project->getDeadline(); ?>">
                                                                <label for="deadline">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Time in devemopment</td>
                                                            <td>
                                                                <input type="text" name="devPeriod"
                                                                    value="<?php echo $this->project->getDevPeriod(); ?>">
                                                                <label for="devPeriod">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr> <?php
                                                                foreach ($this->readTable('Services') as $key) {
                                                                    $selected[$key['name']] = '';
                                                                }
                                                                $selected[$this->service->getById('Services', $this->project->getServiceId())['name']] = 'selected="selected"';
                                                            ?> <td>Service</td>
                                                            <td>
                                                                <select name="service"> <?php
                                                                        foreach ($this->readTable('Services') as $value):
                                                                    ?> <option <?=$selected[$value['name']];?>
                                                                        value="<?php echo $value['id']; ?>">
                                                                        <?php echo $value['name']; ?> </option>
                                                                    <?php endforeach; ?> </select>
                                                            </td>
                                                        </tr>
                                                        <tr> <?php
                                                                foreach ($this->readTable('ProjectTypes') as $key) {
                                                                    $selected[$key['name']] = '';
                                                                }
                                                                $selected[$this->service->getById('ProjectTypes', $this->project->getTypeId())['name']] = 'selected="selected"';
                                                            ?> <td>Project type</td>
                                                            <td>
                                                                <select name="type"> <?php
                                                                        foreach ($this->readTable('ProjectTypes') as $value):
                                                                    ?> <option <?=$selected[$value['name']];?>
                                                                        value="<?php echo $value['id']; ?>">
                                                                        <?php echo $value['name']; ?> </option>
                                                                    <?php endforeach; ?> </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alias</td>
                                                            <td>
                                                                <input type="text" name="alias"
                                                                    value="<?php echo $this->project->getAlias(); ?>">
                                                                <label for="alias">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Html text</td>
                                                            <td>
                                                                <input type="text" name="textHtml"
                                                                    value="<?php echo $this->project->getTextHtml(); ?>">
                                                                <label for="textHtml">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Images (tap to remove)</td>
                                                            <td class="form-images form-images-multiple">
                                                                <div class="btn-text open-medialibrary">Choose from
                                                                    medialibrary</div> <?php
                                                                    foreach ($this->getProjectImages($this->project->getId()) as $value):
                                                                ?> <img class="form-image"
                                                                    data-id="<?php echo $value['image_id']; ?>"
                                                                    src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>">
                                                                <input type="hidden" name="images[]" class="form-hidden"
                                                                    value="<?php echo $value['image_id']; ?>">
                                                                <?php endforeach; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Preview image</td>
                                                            <td class="form-images form-images-single">
                                                                <div class="btn-text open-medialibrary-single">Choose
                                                                    from medialibrary</div> <?php
                                                                    $im = $this->project->getById('Medialibrary', $this->project->getPreviewId());
                                                                ?> <img class="form-image"
                                                                    src="<?php echo '/controllers/uploads/' . $im['imageSrc']; ?>">
                                                                <input type="hidden" name="preview" class="form-hidden"
                                                                    value="<?php echo $im['id']; ?>">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <button name="edit-btn" type="submit" class="btn-main">Add changes</button>
                                        </div>
                                    </form>
                                    <form class="form" action="/adm1n/edit" method="post">
                                        <input type="hidden" name="table" value="ProjectTeam">
                                        <input type="hidden" name="itemId"
                                            value="<?php echo $this->project->getId(); ?>">
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
                                                            $teamList = $this->getProjectTeam($this->project->getId());
                                                            $teamsIds = [];
                                                            
                                                            foreach ($teamList as $item) {
                                                                $teamsIds[] = $item['member_id'];
                                                            }
                                                            
                                                            foreach ($this->readTable('Team') as $key) {
                                                                $checked[$key['id']] = in_array($key['id'], $teamsIds) ? 'checked' : '';
                                                            }
                                                        
                                                            foreach ($this->readTable('Team') as $value):
                                                        ?> <tr>
                                                            <td style="text-align: center;">
                                                                <img
                                                                    src="<?php echo '/controllers/uploads/' . $this->teamMember->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>">
                                                            </td>
                                                            <td><?php echo $value['name']; ?></td>
                                                            <td>
                                                                <input type="checkbox" name="teamMembers[]"
                                                                    <?php echo $checked[$value['id']]; ?>
                                                                    value="<?php echo $value['id']; ?>">
                                                            </td>
                                                        </tr> <?php endforeach; ?> </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <button name="edit-btn" type="submit" class="btn-main">Add changes</button>
                                        </div>
                                    </form>
                                    <form class="form" action="/adm1n/edit" method="post">
                                        <input type="hidden" name="table" value="Technologies">
                                        <input type="hidden" name="itemId"
                                            value="<?php echo $this->project->getId(); ?>">
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
                                                            $techList = $this->getProjectTechnologies($this->project->getId());
                                                            $techIds = [];
                                                            
                                                            foreach ($techList as $item) {
                                                                $techIds[] = $item['technology_id'];
                                                            }

                                                            foreach ($this->readTable('TechnologiesList') as $key) {
                                                                $checked[$key['id']] = in_array($key['id'], $techIds) ? 'checked' : '';
                                                            }
                                                            
                                                            foreach ($this->readTable('TechnologiesList') as $value):
                                                        ?> <tr>
                                                            <td>
                                                                <img style="width: 100px;"
                                                                    src="<?php echo '/controllers/uploads/' . $this->technology->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="technologies[]"
                                                                    <?php echo $checked[$value['id']]; ?>
                                                                    value="<?php echo $value['id']; ?>">
                                                            </td>
                                                        </tr> <?php endforeach; ?> </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <button name="edit-btn" type="submit" class="btn-main">Add changes</button>
                                        </div>
                                    </form> <?php } ?>
                                </div>
                                <div class="hero__tabs form-edit" <?php echo $display['Services']; ?>> <?php 
                                        if ($this->service->getId()) { ?> <form class="form" action="/adm1n/edit"
                                        method="post">
                                        <input type="hidden" name="table" value="Services">
                                        <input type="hidden" name="itemId"
                                            value="<?php echo $this->service->getId(); ?>">
                                        <div class="hero__tab">
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
                                                                    value="<?php echo $this->service->getName(); ?>">
                                                                <label for="name">*</label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <button name="edit-btn" type="submit" class="btn-main">Add changes</button>
                                        </div>
                                    </form> <?php } ?> </div>
                                <div class="hero__tabs form-edit" <?php echo $display['ProjectTypes']; ?>> <?php 
                                        if ($this->projectType->getId()) { ?> <form class="form" action="/adm1n/edit"
                                        method="post">
                                        <input type="hidden" name="table" value="ProjectTypes">
                                        <input type="hidden" name="itemId"
                                            value="<?php echo $this->projectType->getId(); ?>">
                                        <div class="hero__tab">
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
                                                                    value="<?php echo $this->projectType->getName(); ?>">
                                                                <label for="name">*</label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <button name="edit-btn" type="submit" class="btn-main">Add changes</button>
                                        </div>
                                    </form> <?php } ?> </div>
                                <div class="hero__tabs form-edit" <?php echo $display['Team']; ?>> <?php 
                                        if ($this->teamMember->getId()) { ?> <form class="form" action="/adm1n/edit"
                                        method="post">
                                        <input type="hidden" name="table" value="Team">
                                        <input type="hidden" name="itemId"
                                            value="<?php echo $this->teamMember->getId(); ?>">
                                        <div class="hero__tab">
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
                                                                    value="<?php echo $this->teamMember->getName(); ?>">
                                                                <label for="name">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Position</td>
                                                            <td>
                                                                <input type="text" name="position"
                                                                    value="<?php echo $this->teamMember->getPosition(); ?>">
                                                                <label for="position">*</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Image</td>
                                                            <td class="form-images form-images-single">
                                                                <div class="btn-text open-medialibrary-single">Choose
                                                                    from medialibrary</div> <?php
                                                                    $member = $this->teamMember->getById('Medialibrary', $this->teamMember->getImageId());
                                                                ?> <img class="form-image"
                                                                    src="<?php echo '/controllers/uploads/' . $member['imageSrc']; ?>">
                                                                <input type="hidden" name="memberImage"
                                                                    class="form-hidden"
                                                                    value="<?php echo $member['id']; ?>">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <button name="edit-btn" type="submit" class="btn-main">Add changes</button>
                                        </div>
                                    </form> <?php } ?> </div>
                                <div class="hero__tabs form-edit" <?php echo $display['TechnologiesList']; ?>> <?php 
                                        if ($this->technology->getId()) { ?> <form class="form" action="/adm1n/edit"
                                        method="post">
                                        <input type="hidden" name="table" value="TechnologiesList">
                                        <input type="hidden" name="itemId"
                                            value="<?php echo $this->technology->getId(); ?>">
                                        <div class="hero__tab">
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
                                                                    from medialibrary</div> <?php
                                                                    $tech = $this->technology->getById('Medialibrary', $this->technology->getImageId());
                                                                ?> <img class="form-image"
                                                                    src="<?php echo '/controllers/uploads/' . $tech['imageSrc']; ?>">
                                                                <input type="hidden" name="techImage"
                                                                    class="form-hidden"
                                                                    value="<?php echo $tech['id']; ?>">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="control-buttons">
                                            <button name="edit-btn" type="submit" class="btn-main">Add changes</button>
                                        </div>
                                    </form> <?php } ?> </div>
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