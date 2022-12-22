<?php
require_once 'model/UserProvider.php';
$pdo = require 'db.php';
session_start();
$pageHeader = 'Authorization';

$error = null;

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['user']);
    unset($_SESSION['quote']);
    session_destroy();
    header("Location: /"); //index.php
    die();
}
if (isset($_POST['user'], $_POST['password'])) {
    ['user' => $username, 'password' => $password] = $_POST;
    $userProvider =  new UserProvider($pdo);
    $user = $userProvider->getByUsernameAndPassword($username, $password);
    if ($user === null) {
        $error = 'User  not found';
    } else {
        $_SESSION['user'] = $user;
        header("Location: /?controller=quotes"); //index.php
        die();
    }
}

include "view/login.php";