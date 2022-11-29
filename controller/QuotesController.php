<?php
include_once 'model/Quote.php';
include_once 'model/User.php';
include_once 'model/QuoteService.php';
session_start();
$pageHeader = 'Quotes list';

$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user']; // ->getFirstName()
} else {
    header("Location: /");
    die();
}

$quoteService = new QuoteService();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            if (isset($_POST['quote'])) {
                ['quote' => $quoteText] = $_POST;
                $quoteService->addQuote(new Quote(rand(1, 1000), $user, $quoteText));
            }
            break;
        case 'mute':
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $quoteService->markUnActual($key);
            }
            break;
        case 'delete':
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $quoteService->deleteQuote($key);
            }
            break;
        case 'top':
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $quoteService->markActual($key);
            }
            break;
    }
    header("Location: /?controller=quotes");
    die();
}

$quotesActual = $quoteService->getActual();
$quotesUnimportant = $quoteService->getUnimportant();

include "view/quotes.php";

