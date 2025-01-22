<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home/css/logster.css">
    <link rel="stylesheet" href="home/css/main.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Login</title>
</head>

<body>
    <main>
        <section id="box1" class="box" data-section-name="Register">
            <!--太陽-->
            <div class="sun">
                <div class="ray_box">
                    <div class="ray ray1"></div>
                    <div class="ray ray2"></div>
                    <div class="ray ray3"></div>
                    <div class="ray ray4"></div>
                    <div class="ray ray5"></div>
                    <div class="ray ray6"></div>
                    <div class="ray ray7"></div>
                    <div class="ray ray8"></div>
                    <div class="ray ray9"></div>
                    <div class="ray ray10"></div>
                </div>
            </div>
            
            <!--飛行機-->
            <div class="plane_wrap"><img src="home/img/plane.png" class="plane"></div>

            <!--ログインコンテナ-->
            <div class="login">
                <form action="home/php/login/login.php" method="POST" class="login__form">


                    <div class="login__inputs">
                        <div class="login__box">
                            <input type="text" name="login_account_id" id="login_account_id" placeholder="ユーザーID"
                                required class="login__input">
                            <span class="material-symbols-outlined">person</span>
                        </div>

                        <div class="login__box">
                            <input type="password" name="password" id="password" placeholder="パスワード" required
                                class="login__input">
                            <span class="material-symbols-outlined">lock</span>
                        </div>
                    </div>

                    <div class="login__check">
                        <div class="login__check-box">
                            <input type="checkbox" class="login__check-input" id="user-check">
                            
                            <label for="user-check" class="login__check-label">ログイン情報を保存する</label>
                        </div>
                    </div>

                    <button type="submit" class="login__button">ログイン</button>

                    <div class="login__register">
                        <a class="goRegister">新規登録</a>
                    </div>
                    <?php
                            session_start();
                            if (isset($_SESSION['error'])) {
                                echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
                                unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo "<div style='color: yellow;'>" . $_SESSION['success'] . "</div>";
                                unset($_SESSION['success']);
                            }
                            ?>
                </form>
                </div>


            <div class="loop_wrap">
                <img src="home/img/cloud1.png" class="cloud" />
                <img src="home/img/cloud1.png" class="cloud" />
            </div>
            <div class="loop_wrap">
                <img src="home/img/cloud2.png" class="cloud" />
                <img src="home/img/cloud2.png" class="cloud" />
            </div>
            <div class="loop_wrap">
                <img src="home/img/cloud3.png" class="cloud" />
                <img src="home/img/cloud3.png" class="cloud" />
            </div>
            <div class="loop_wrap">
                <img src="home/img/cloud4.png" class="cloud" />
                <img src="home/img/cloud4.png" class="cloud" />
            </div>


        </section>
        <section id="box2" class="box" data-section-name="Login">

        <div class="balloon_wrap"><img src="home/img/balloon.png" class="balloon"></div>
        <div class="register">

                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['error'])) {
                    echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "<div style='color: yellow;'>" . $_SESSION['success'] . "</div>";
                    unset($_SESSION['success']);
                }
                ?>

                <form action="home/php/login/register.php" method="POST" class="register__form">

                    <div class="login__inputs">
                        <div class="login__box">
                            <input type="name" name="user_name" id="user_name" placeholder="名前" required
                                class="login__input">
                            <span class="material-symbols-outlined">id_card</span>
                        </div>

                        <div class="login__box">
                            <input type="text" name="user_id" id="user_id" placeholder="ユーザーID" required
                                class="login__input">
                            <span class="material-symbols-outlined">person</span>
                        </div>

                        <div class="login__box">
                            <input type="password" name="login-password" id="login-password" placeholder="パスワード"
                                required class="login__input">
                            <span class="material-symbols-outlined">lock</span>
                        </div>

                        <div class="login__box">
                            <input type="password" name="confirm-password" id="confirm-password" placeholder="確認"
                                required class="login__input">
                            <span class="material-symbols-outlined">lock</span>
                        </div>
                    </div>

                    <div class="login__check">
                        <div class="login__check-box">
                            <input type="checkbox" class="login__check-input" id="user-check">
                            <label for="user-check" class="login__check-label">ログイン情報を保存する</label>
                        </div>
                    </div>

                    <button type="submit" class="login__button">登録する</button>

                    <div class="login__register">
                       <a class="goLogin">ログイン</a>
                    </div>
                </form>
            </div>



            <div class="loop_wrap2"><img src="home/img/cloud1.png" class="cloud" /><img src="home/img/cloud1.png"
                    class="cloud" /></div>
            <div class="loop_wrap2"><img src="home/img/cloud2.png" class="cloud" /><img src="home/img/cloud2.png"
                    class="cloud" /></div>
            <div class="loop_wrap2"><img src="home/img/cloud3.png" class="cloud" /><img src="home/img/cloud3.png"
                    class="cloud" /></div>
            <div class="loop_wrap2"><img src="home/img/cloud4.png" class="cloud" /><img src="home/img/cloud4.png"
                    class="cloud" /></div>

        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollify/1.0.21/jquery.scrollify.min.js"></script>
    <!-- <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> -->
    <script src="home/js/logster.js"></script>

</body>

</html>