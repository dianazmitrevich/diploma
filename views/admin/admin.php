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
                                </div> <?php
                                if ($_SESSION['isAdmin'] == 1) {
                                ?> <div class="header__col-profile">
                                    <a href="/adm1n/profile">
                                        <div class="btn-round"></div>
                                    </a>
                                </div> <?php } ?> <div class="header__col-logout">
                                    <a href="/snc">
                                        <div class="btn-round"></div>
                                    </a>
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
                                <div class="hero__title h2">Admin page</div>
                                <div class="hero__tabs">
                                    <div class="hero__tab">
                                        <span> Projects <div class="hero__tab-add">
                                                <form action="/adm1n/add" method="post">
                                                    <input type="hidden" name="table" value="Projects">
                                                    <button type="submit">+ Add new</button>
                                                </form>
                                            </div>
                                        </span>
                                        <div class="tab">
                                            <table class="tab__table">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">Preview</th>
                                                        <th>Name</th>
                                                        <th class="table-actions">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody> <?php
                                                        foreach ($this->readTable('Projects') as $value):
                                                    ?> <tr>
                                                        <td style="text-align: center;">
                                                            <img src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $value['preview_id'])['imageSrc']; ?>"
                                                                alt="S&C">
                                                        </td>
                                                        <td> <?php echo $value['name']; ?> </td>
                                                        <td class="table-buttons">
                                                            <div class="wrap">
                                                                <form method="post" action="/adm1n/edit">
                                                                    <input type="hidden" name="table" value="Projects">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit"
                                                                        class="btn-text edit-btn">Edit</button>
                                                                </form>
                                                                <form method="post" action="/adm1n/delete">
                                                                    <input type="hidden" name="table" value="Projects">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit" class="btn-text delete-btn"
                                                                        onclick="return confirmDelete()">Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr> <?php endforeach; ?> </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="hero__tab">
                                        <span> Services <div class="hero__tab-add">
                                                <form action="/adm1n/add" method="post">
                                                    <input type="hidden" name="table" value="Services">
                                                    <button type="submit">+ Add new</button>
                                                </form>
                                            </div>
                                        </span>
                                        <div class="tab">
                                            <table class="tab__table">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="table-actions">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody> <?php
                                                        foreach ($this->readTable('Services') as $value):
                                                    ?> <tr>
                                                        <td class="table-name"> <?php echo $value['name']; ?> </td>
                                                        <td class="table-buttons">
                                                            <div class="wrap">
                                                                <form method="post" action="/adm1n/edit">
                                                                    <input type="hidden" name="table" value="Services">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit"
                                                                        class="btn-text edit-btn">Edit</button>
                                                                </form>
                                                                <form method="post" action="/adm1n/delete">
                                                                    <input type="hidden" name="table" value="Services">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit" class="btn-text delete-btn"
                                                                        onclick="return confirmDelete()">Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr> <?php endforeach; ?> </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="hero__tab">
                                        <span> Project types <div class="hero__tab-add">
                                                <form action="/adm1n/add" method="post">
                                                    <input type="hidden" name="table" value="ProjectTypes">
                                                    <button type="submit">+ Add new</button>
                                                </form>
                                            </div>
                                        </span>
                                        <div class="tab">
                                            <table class="tab__table">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="table-actions">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody> <?php
                                                        foreach ($this->readTable('ProjectTypes') as $value):
                                                    ?> <tr>
                                                        <td class="table-name"> <?php echo $value['name']; ?> </td>
                                                        <td class="table-buttons">
                                                            <div class="wrap">
                                                                <form method="post" action="/adm1n/edit">
                                                                    <input type="hidden" name="table"
                                                                        value="ProjectTypes">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit"
                                                                        class="btn-text edit-btn">Edit</button>
                                                                </form>
                                                                <form method="post" action="/adm1n/delete">
                                                                    <input type="hidden" name="table"
                                                                        value="ProjectTypes">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit" class="btn-text delete-btn"
                                                                        onclick="return confirmDelete()">Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr> <?php endforeach; ?> </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="hero__tab">
                                        <span> Team <div class="hero__tab-add">
                                                <form action="/adm1n/add" method="post">
                                                    <input type="hidden" name="table" value="Team">
                                                    <button type="submit">+ Add new</button>
                                                </form>
                                            </div>
                                        </span>
                                        <div class="tab">
                                            <table class="tab__table">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">Preview</th>
                                                        <th>Name</th>
                                                        <th class="table-actions">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody> <?php
                                                        foreach ($this->readTable('Team') as $value):
                                                    ?> <tr>
                                                        <td style="text-align: center;">
                                                            <img src="<?php echo '/controllers/uploads/' . $this->project->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>"
                                                                alt="S&C">
                                                        </td>
                                                        <td class="table-name"><?php echo $value['name']; ?> </td>
                                                        <td class="table-buttons">
                                                            <div class="wrap">
                                                                <form method="post" action="/adm1n/edit">
                                                                    <input type="hidden" name="table" value="Team">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit"
                                                                        class="btn-text edit-btn">Edit</button>
                                                                </form>
                                                                <form method="post" action="/adm1n/delete">
                                                                    <input type="hidden" name="table" value="Team">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit" class="btn-text delete-btn"
                                                                        onclick="return confirmDelete()">Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr> <?php endforeach; ?> </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="hero__tab">
                                        <span> Technologies <div class="hero__tab-add">
                                                <form action="/adm1n/add" method="post">
                                                    <input type="hidden" name="table" value="TechnologiesList">
                                                    <button type="submit">+ Add new</button>
                                                </form>
                                            </div>
                                        </span>
                                        <div class="tab">
                                            <table class="tab__table">
                                                <thead>
                                                    <tr>
                                                        <th>Preview</th>
                                                        <th class="table-actions">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody> <?php
                                                        foreach ($this->readTable('TechnologiesList') as $value):
                                                    ?> <tr>
                                                        <td>
                                                            <img src="<?php echo '/controllers/uploads/' . $this->technology->getById('Medialibrary', $value['image_id'])['imageSrc']; ?>"
                                                                alt="S&C">
                                                        </td>
                                                        <td class="table-buttons">
                                                            <div class="wrap">
                                                                <form method="post" action="/adm1n/edit">
                                                                    <input type="hidden" name="table"
                                                                        value="TechnologiesList">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit"
                                                                        class="btn-text edit-btn">Edit</button>
                                                                </form>
                                                                <form method="post" action="/adm1n/delete">
                                                                    <input type="hidden" name="table"
                                                                        value="TechnologiesList">
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo $value['id']; ?>">
                                                                    <button type="submit" class="btn-text delete-btn"
                                                                        onclick="return confirmDelete()">Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr> <?php endforeach; ?> </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="hero__tab">
                                        <span> Medialibrary <div class="hero__tab-add">
                                                <form action="/adm1n/add" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="table" value="Medialibrary">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                                    <input name="userfile[]" type="file" multiple="multiple"
                                                        id="file" />
                                                    <button type="submit" name="files-add-btn">+ Add files</button>
                                                </form>
                                            </div>
                                        </span>
                                        <div class="tab">
                                            <form class="form" method="post" action="/adm1n/delete">
                                                <input type="hidden" name="table" value="Medialibrary">
                                                <div class="form__wrap"> <?php
                                                        foreach ($this->readTable('Medialibrary') as $value):
                                                    ?> <div class="form__item">
                                                        <input type="checkbox" name="images[]"
                                                            value="<?php echo $value['id']; ?>">
                                                        <img style="width: 100px"
                                                            src="/controllers/uploads/<?php echo $value['imageSrc']; ?>">
                                                    </div> <?php endforeach; ?> </div>
                                                <button type="submit" class="btn-text delete-btn"
                                                    onclick="return confirmDelete()">Delete</button>
                                            </form>
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