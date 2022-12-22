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
<form class="formq form" method="post" >
    <div class="errortext <?=$error === null ? 'hidden' : ''?>"><?=$error?></div>
    <input type="text" id="user" name="user" placeholder="Username" required>
    <input type="password" id="password" name="password" placeholder="Password" required>
    <button type="submit" class="submitbutton">Login</button>
</form>
</body>