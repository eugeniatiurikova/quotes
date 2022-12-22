<?php
//session_start();
//unset($_SESSION['user']);
try {
    $controller = $_GET['controller'] ?? 'index';
    $routes = require 'routes.php';
    require_once $routes[$controller];
} catch (Throwable $e) {
    die('Something went totally wrond: '.$e->getMessage());
}


//include_once 'Quote.php';
//include_once 'QuoteService.php';
//include_once 'User.php';
//include_once 'Comment.php';
//
// $user = new User('John','Doe','johndoe@email.com',25);
// $quote = new Quote($user, 'No matter how dirty the business, do it well');
// $quote->setPriority(5);
// QuoteService::addComment($user,$quote,'I agree');
// QuoteService::addComment($user,$quote,'No, I disagree');
//
//print_r($user);
//print_r($quote);

//echo "<pre>";
//var_dump($_GET);
//var_dump($_POST);






