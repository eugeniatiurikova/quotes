<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$pageHeader?></title>
</head>
<body>
<?php include "menu.php";?>
<form action="/?controller=quotes&action=add" method="post">
    <input type="text" name="quote" placeholder="Add new quote">
    <input type="submit" value="Add">
</form><br>
<p><b>Actual quotes:</b></p>
<?php foreach ($quotesActual as $quote) :?>
<li><?=$quote->getDescription()?> <a href="/?controller=quotes&action=mute&key=<?=$quote->getKey()?>">[↓]</a></li>
<?php endforeach;?>
<p><b>Not actual quotes:</b></p>
<?php foreach ($quotesUnimportant as $quote) :?>
    <li><?=$quote->getDescription()?> <a href="/?controller=quotes&action=top&key=<?=$quote->getKey()?>">[↑]</a> <a href="/?controller=quotes&action=delete&key=<?=$quote->getKey()?>">[×]</a></li>
<?php endforeach;?>
</body>
</html>
