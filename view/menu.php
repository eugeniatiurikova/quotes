<h1><?=$pageHeader?></h1>
<?php

(isset($_SESSION['user'])) ?
    $user = $_SESSION['user'] :
    $user = null;

?>
<div class="mainnav">
<?php if ($user) : ?>
    <?php if ($controller === 'quotes') : ?><p class="mainmenu"><a href="/">Home</a>
    <?php else : ?><p class="mainmenu"><a href="/?controller=quotes">Quotes</a></p>
    <?php endif ?>
    <?php if ($controller === 'quotes') : ?>&nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp; <span id="addquote" class="aspan">Add&nbsp;new&nbsp;quote</span><?php endif ?>
<?php endif ?>
<?php if (!$user) : ?>
    <p class="mainmenu"><a href="/?controller=security">Log In to add quotes</a> &nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp; <a href="/?controller=register">New&nbsp;user</a>
<?php endif ?></p>
<?php if ($user) : ?><p class="addedby">User: <?=$user->getName()?> (<?=$user->getUsername()?>)
        &nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp; <a href="?controller=security&action=logout">Log&nbsp;Out</a>&nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp;<a href="/?controller=register">New&nbsp;user</a></p>
<?php endif ?>
</div>
