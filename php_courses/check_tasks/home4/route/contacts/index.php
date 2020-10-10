<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
<div class="header">
    <div class="logo"><img src="../../i/logo.png" width="68" height="23" alt="Project"></div>
    <div class="clearfix"></div>
</div>

<div class="clear">
    <ul class="main-menu">
        <?php showMenu($mainMenu); ?>
    </ul>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">

            <h1><?= outputHead($mainMenu) ?></h1>
            <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с
                друзьями и просматривать списки друзей.</p>


        </td>
    </tr>
</table>

<div class="clearfix">
    <ul class="main-menu bottom">
        <?php showMenu($mainMenu, 'foot'); ?>
    </ul>
</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>

