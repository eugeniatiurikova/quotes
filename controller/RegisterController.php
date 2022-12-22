<?php
require_once "model/User.php";
require_once 'model/UserProvider.php';
$pdo = require 'db.php';
session_start();
$pageHeader = 'Registration';

$error = null;

if (isset($_POST['reg_name']) && isset($_POST['reg_user']) && isset($_POST['reg_password'])) {
    ['reg_name' => $reg_name, 'reg_user' => $reg_user, 'reg_password' => $reg_password] = $_POST;

    $user = new User($reg_user);
    $user->setName($reg_name);

    $userProvider = new UserProvider($pdo);
    try {
        $user->setId($userProvider->registerUser($user, $reg_password));
        $_SESSION['user'] = $user;
        header('Location: /?controller=quotes');
        die();
    } catch (UserExistsException $e) {
        $error = $e->getMessage();
    }

}

require_once 'view/register.php';
