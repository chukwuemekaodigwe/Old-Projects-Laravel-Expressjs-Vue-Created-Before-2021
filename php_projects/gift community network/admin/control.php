<?php

ini_set("display_errors", true);
date_default_timezone_set("Africa/Lagos");

/*
define("DB_DSN", "mysql:host=localhost;dbname=busimyol_gifting;charset=utf8mb4");
define("DB_USERNAME", "busimyol_gifting");
define("DB_PASSWORD", "xf!-B?Ufs]lj");
 */

define("DB_DSN", "mysql:host=localhost;dbname=gifting_community;charset=utf8mb4");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define('DB_NAME', 'gifting_community');


$Ex = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$_SESSION['dbErr'] = $Ex;

define("SUPER-ADMIN", 0);
define("ADMIN", 1);
define("CLIENT", 2);
define("EXPIRED", 3);

define("CLASS_PATH", "assets/class");
define("CORP", "Community Gifting Cycle");
define("PENDING", 1);
define("CONFIRM", 2);
define("DEPOSIT", 1);
define("WITHDRAW", 2);

require CLASS_PATH . "/class.transactions.php";
require CLASS_PATH . "/class.users.php";
require CLASS_PATH . "/ssp.php";
require CLASS_PATH . "/mailerClass.php";

if (isset($_SESSION['set_cookie'])) {
    $data = array();
    $data = $_SESSION['set_cookie'];
    list($name, $value, $duratn) = $data;

    setcookie($name, $value, $duratn);
}
//$_SESSION['ulevel'] = CLIENT; $_SESSION['pin'] = 3;
