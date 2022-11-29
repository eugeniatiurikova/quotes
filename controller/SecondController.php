<?php
require_once 'model/User.php';
session_start();
$pageHeader = 'Second page';

//if (isset($_GET['action']) && $_GET['action'] === 'logout') {
//    unset($_SESSION['user']);
//}

include "view/second.php";