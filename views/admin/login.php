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
                                <div class="hero__logo">
                                    <a href="/" title="Back to the main page">
                                        <img src="/resources/images/logo.svg" alt="S&C">
                                    </a>
                                </div>
                                <div class="hero__form">
                                    <form class="form" method="post" action="/snc">
                                        <div class="form__wrap"> <?php if (!empty($err)) { ?> <div class="form__error"> <?php
                                                echo $err;
                                                ?> </div> <?php } ?> <div class="form__field">
                                                <input type="text" name="login" required placeholder="Login"
                                                    maxlength="50">
                                                <label for="login"></label>
                                            </div>
                                            <div class="form__field mb-0">
                                                <input type="password" name="password" required placeholder="Password"
                                                    maxlength="50">
                                                <label for="password"></label>
                                            </div>
                                            <div class="form__field mt-6">
                                                <input type="submit" value="Login" name="login-btn">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="/snc" method="post">
                                        <div class="form-register">Have an invitation code? <button type="submit"
                                                name="signup-page">Register</button>
                                        </div>
                                    </form>
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