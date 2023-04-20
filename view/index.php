<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title><?=$pageHeader?></title>
</head>
<body>
<?php include "menu.php" ?>
<p class="quotetext">You have to login or register to add or manage quotes.<br>We only need your name so we know who to credit as the person who shared the quote. Well, you also need a password.</p>
<h2>Quotes of the day:</h2>
<div class="actuals">
    <?php foreach ($quotesRandom as $quote) :
        include 'quote-a.php';
    endforeach;?>
</div>
</body>
</html>
