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
                                <div class="header__col-back">
                                    <a href="/adm1n">
                                        <div class="btn-round"></div>
                                    </a>
                                </div>
                                <div class="header__col-logout">
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
                                <div class="hero__title h2">Profile</div>
                                <div class="hero__keys">
                                    <div class="hero__subtitle">
                                        <span>Manage invite keys</span>
                                        <form action="/adm1n/add" method="post">
                                            <input type="hidden" name="table" value="Moderators">
                                            <button name="add-key" type="submit">+ Add new</button>
                                        </form>
                                    </div>
                                    <div class="keys tab">
                                        <table class="tab__table">
                                            <thead>
                                                <tr>
                                                    <th>Login</th>
                                                    <th>Invite key</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php
                                                        foreach ($this->moderator->getModerators() as $value):
                                                    ?> <tr>
                                                    <td><?php echo $value['login']; ?></td>
                                                    <td><?php echo $value['inviteKey']; ?></td>
                                                    <td class="table-buttons">
                                                        <div class="wrap">
                                                            <form method="post" action="/adm1n/delete">
                                                                <input type="hidden" name="table" value="Moderators">
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