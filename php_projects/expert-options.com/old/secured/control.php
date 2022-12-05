<?php
ini_set("display_errors", true);
date_default_timezone_set("Africa/Lagos");

/*define("DB_DSN", "mysql:host=localhost;dbname=u0699609_default;charset=utf8mb4");
define("DB_USERNAME", "u0699609_bp5am");
define("DB_PASSWORD", "V8jug4F6ONQ0q80L");
*/
define("DB_DSN", "mysql:host=localhost;dbname=bitcoin4;charset=utf8mb4");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

$Ex = array(PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT);
$_SESSION['dbErr'] = $Ex;

define("ADMIN", 1);
define("CLIENT", 2);
define("CLASS_PATH", "assets/class");
define("CORP", "Crypto Benefit Inc ");
define("PENDING", 1);
define("CONFIRM", 2);
define("DEPOSIT", 1);
define("WITHDRAW", 2);

require(CLASS_PATH . "/class.transactions.php");
require(CLASS_PATH . "/class.users.php");
require(CLASS_PATH."/mailerClass.php");


//$_SESSION['user_type'] = 1;
?>