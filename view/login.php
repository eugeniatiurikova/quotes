<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$pageHeader?></title>
    <style>
        .hidden {
            position:absolute;
            width:1px;
            height:1px;
            padding:0;
            margin:-1px;
        }
        .redtext {
            color: red;
        }
    </style>
</head>
<body>
<?php include "menu.php" ?>
<form method="post" >
    <div class="redtext <?=$error === null ? 'hidden' : ''?>">
        <?=$error?><br><br>
    </div>
    <label for="user" class="visually-hidden">Username</label>
    <input type="text" id="user" name="user" placeholder="Username" required="" autofocus=""><br>
    <label for="password" class="visually-hidden">Password</label>
    <input type="password" id="password" name="password" placeholder="Password" required=""><br>
    <button type="submit">Войти</button>
</form>
</body>