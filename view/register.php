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
    <input type="text" id="reg_name" name="reg_name" placeholder="Your name" required>
    <input type="text" id="reg_user" name="reg_user" placeholder="Username" required>
    <input type="password" id="reg_password" name="reg_password" placeholder="Password" required>
    <button type="submit" class="submitbutton">Register</button>
</form>
</body>