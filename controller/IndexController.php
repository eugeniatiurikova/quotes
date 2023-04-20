<?php
require_once 'model/User.php';
include_once 'model/Quote.php';
include_once 'model/QuoteService.php';
$pdo = require 'db.php';
session_start();
$pageHeader = 'Welcome';

$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user']; // ->getFirstName()
}

$quoteService = new QuoteService($pdo);
$quoteService->getQuotes();
$quotesRandom = $quoteService->getRandom(3);

include "view/index.php";