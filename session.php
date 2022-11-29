<?php
session_start();
$_SESSION['login'] = 'admin';
echo "<pre>";
print_r($_SESSION);