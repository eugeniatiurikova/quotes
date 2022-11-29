<h1><?=$pageHeader?></h1>
<?php
$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if ($user) : ?> User: <?=$user->getUserName()?> | <?php endif ?>
<a href="/">Main</a> |
<a href="/?controller=second">Second</a>
<?php if ($user) : ?>
    | <a href="/?controller=quotes">Quotes</a>
    | <a href="?controller=security&action=logout">LogOut</a><br><br>
<?php else : ?>
    | <a href="/?controller=security">LogIn</a><br><br>
<?php endif ?>

