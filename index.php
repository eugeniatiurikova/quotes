<?php

try {
    $controller = $_GET['controller'] ?? 'index';
    $routes = require 'routes.php';
    require_once $routes[$controller];
} catch (Throwable $e) {
    die('Something went totally wrond: '.$e->getMessage());
}
