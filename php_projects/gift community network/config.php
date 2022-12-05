<?php
ini_set("display_errors", false);
date_default_timezone_set("Africa/Lagos");

define("DB_DSN", "mysql:host=localhost;dbname=gifting_community;charset=utf8mb4");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "gifting_community");

/*
define("DB_DSN", "mysql:host=localhost;dbname=busimyol_gifting;charset=utf8mb4");
define("DB_USERNAME", "busimyol_gifting");
define("DB_PASSWORD", "xf!-B?Ufs]lj");
define("DB_NAME", "busimyol_gifting");
*/
$Ex = array(PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$_SESSION['dbErr'] = $Ex;

define("ADMIN", 1);
define("CLIENT", 2);
define("CLASS_PATH", "admin/assets/class");
define("CORP", "Community Gifting Cycle");

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