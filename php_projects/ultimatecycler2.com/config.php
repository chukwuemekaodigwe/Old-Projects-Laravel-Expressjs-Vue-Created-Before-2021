<?php
ini_set("display_errors", TRUE);
date_default_timezone_set("Africa/Lagos");
/*
define("DB_DSN", "mysql:host=localhost;dbname=u0725656_default;charset=utf8mb4");
define("DB_USERNAME", "u0725656_cycler");
define("DB_PASSWORD", "contra1964.VM");
*/

define("DB_DSN", "mysql:host=localhost;dbname=cycler;charset=utf8mb4");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");


$Ex = array(PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$_SESSION['dbErr'] = $Ex;

define("ADMIN", 1);
define("CLIENT", 2);
define("CLASS_PATH", "secured/assets/class");
define("CORP", "Ultimate Cycler II");

define("PENDING", 0);
define("CONFIRM", 1);

define("ACTIVE", 1);
define("UN_ACTIVATED", 2);
define("SUSPENDED", 3);


require(CLASS_PATH . "/class.transactions.php");
require(CLASS_PATH . "/class.users.php");
require(CLASS_PATH."/mailerClass.php");

//$_SESSION['user_type'] = 1;
?>