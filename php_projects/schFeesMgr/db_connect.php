<?php
ini_set('default_timezone', 'Africa/Lagos');
ini_set('display_errors', true);
//session_start();

$dsn = 'mysql:host=localhost;dbname=schfee_mgr;charset=utf8mb4';
$dbUser = 'drakelegend';
$dbPass = 'admin1234';
$errMode = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

define('DSN', 'mysql:host=localhost;dbname=schfee_mgr;charset=utf8mb4');
define('USER', 'drakelegend');
define('PASS', 'admin1234');

$_SESSION['errMode'] = $errMode;
$db = new PDO($dsn, $dbUser, $dbPass, $errMode);


?>