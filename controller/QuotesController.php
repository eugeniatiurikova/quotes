<?php
include_once 'model/Quote.php';
include_once 'model/User.php';
include_once 'model/QuoteService.php';
$pdo = require 'db.php';
session_start();
$pageHeader = 'Quotes list';

$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user']; // ->getFirstName()
} else {
    header("Location: /");
    die();
}

$quoteService = new QuoteService($pdo);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
//            if (isset($_GET['text'])) { // Обработка данных при отправлении через GET
//                ['text' => $quoteText, 'author' => $quoteAuthor] = $_GET;
//                if ($quoteText != '') {
//                    $quote = new Quote($user->getUsername(), $quoteAuthor, $quoteText);
//                    $quote->setId(rand(1, 1000))->setUserName($user->getName());
//                    $quoteService->addQuote($quote);
//                }
//            }
//            $response = [
//                'status' => 'ok',
//                'key' => $quote->getId(),
//                'user_name' => $quote->getUserName(),
//                'author' => $quote->getAuthor(),
//                'description' => $quote->getDescription(),
//            ];
            $data = json_decode(file_get_contents('php://input'));
            if ($data->author && $data->description) {
                $quoteText = $data->description;
                $quoteAuthor = $data->author;
                if ($quoteText != '') {
                    $quote = new Quote($user->getUsername(), $quoteAuthor, $quoteText);
                    $quote->setId(rand(1, 1000))->setUserName($user->getName());
                    $quoteService->addQuote($quote);
                }
                $response = [
                    'status' => 'ok',
                    'key' => $quote->getId(),
                    'user_name' => $quote->getUserName(),
                    'author' => $quote->getAuthor(),
                    'description' => $quote->getDescription(),
                ];
                echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                die();
            }
            break;
        case 'mute':
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $quoteService->markUnActual($key);
                $tmpquote = $quoteService->getQuote($key);
                $response = [
                    'status' => 'ok',
                    'key' => $key,
                    'user_name' => $tmpquote->getUserName(),
                    'author' => $tmpquote->getAuthor(),
                    'description' => $tmpquote->getDescription(),
                ];
                echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                die();
            }
            break;
        case 'delete':
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $response = [
                    'status' => 'ok',
                    'key' => $key,
                ];
                try {
                    $quoteService->deleteQuote($key, $user->getUsername());
                } catch (NotThisUsersQuoteException $e) {
                    $response = [
                        'status' => 'error',
                        'error_message' => $e->getMessage(),
                        'key' => $key,
                    ];
                }
                echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                die();
            }
            break;
        case 'top':
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $quoteService->markActual($key);
                $tmpquote = $quoteService->getQuote($key);
                $response = [
                    'status' => 'ok',
                    'key' => $key,
                    'user_name' => $tmpquote->getUserName(),
                    'author' => $tmpquote->getAuthor(),
                    'description' => $tmpquote->getDescription(),
                ];
                echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                die();
            }
            break;
    }
//    header("Location: /?controller=quotes");
//    die();
}
$quoteService->getQuotes();
$quotesActual = $quoteService->getActual();
$quotesUnimportant = $quoteService->getUnimportant();

include "view/quotes.php";

