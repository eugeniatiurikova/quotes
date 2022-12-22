<h1><?=$pageHeader?></h1>
<?php
(isset($_SESSION['user'])) ?
    $user = $_SESSION['user'] :
    $user = null;

//var_dump($controller);

if ($user) : ?>
    <div class="mainnav"><p class="mainmenu"><a href="/?controller=quotes">Quotes</a>
    <?php if ($controller === 'quotes') : ?>&nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp; <span id="addquote" class="aspan">Add&nbsp;new&nbsp;quote</span><?php endif ?>
<?php endif ?>
<?php if (!$user) : ?>
    <a href="/?controller=security">Log In</a> &nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp; <a href="/?controller=register">New&nbsp;user</a>
<?php endif ?></p>
<?php if ($user) : ?><p class="addedby">User: <?=$user->getName()?> (<?=$user->getUsername()?>)
        &nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp; <a href="?controller=security&action=logout">Log&nbsp;Out</a>&nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp;<a href="/?controller=register">New&nbsp;user</a></p></div>
<?php endif ?>