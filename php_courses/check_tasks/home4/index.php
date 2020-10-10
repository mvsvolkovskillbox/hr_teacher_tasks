<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
<div class="header">
    <div class="logo"><img src="../../i/logo.png" width="68" height="23" alt="Project"></div>
    <div class="clearfix"></div>
</div>

<div class="clear">
    <ul class="main-menu">
        <?=showMenu($mainMenu)?>
    </ul>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">

            <h1><?= outputHead($mainMenu) ?></h1>
            <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с
                друзьями и просматривать списки друзей.</p>


        </td>
        <td class="right-collum-index">

            <div class="project-folders-menu">
                <ul class="project-folders-v">
                    <li class="project-folders-v-active"><a href="/?login=yes">Авторизация</a></li>
                    <li><a href="#">Регистрация</a></li>
                    <li><a href="#">Забыли пароль?</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <?php

            if (!empty($_GET['login']) && $_GET['login'] === 'yes') {

                ?>
                <div class="index-auth">
                    <form action="/?login=yes" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="iat">
                                    <label for="login_id">Ваш e-mail:</label>
                                    <input id="login_id" size="30" name="login"
                                           value="<?= $login ?? $login = '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="iat">
                                    <label for="password_id">Ваш пароль:</label>
                                    <input id="password_id" size="30" name="password" type="password"
                                           value="<?= $password ?? $password = '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="Войти" name="submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            <?php }

            if ($isAuth) {
                include $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';
            } elseif ($isAuth === false) {
                include $_SERVER['DOCUMENT_ROOT'] . '/include/errors.php';
            }

            ?>
        </td>
    </tr>
</table>

<div class="clearfix">
    <ul class="main-menu bottom">
        <?=showMenu($mainMenu, 'foot')?>
    </ul>
</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>

