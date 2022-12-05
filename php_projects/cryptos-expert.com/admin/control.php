<?php
ini_set("display_errors", TRUE);
//ini_set("allow_url_fopen", 1);
date_default_timezone_set("Africa/Lagos");
/*
define("DB_DSN", "mysql:host=localhost;dbname=u0563892_default;charset=utf8mb4");
define("DB_USERNAME", "u0563892_default");
define("DB_PASSWORD", "rvSX_0QG");
*/

define("DB_DSN", "mysql:host=localhost;dbname=cryptozone;charset=utf8mb4");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

$Ex = array(PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$_SESSION['dbErr'] = $Ex;

define("ADMIN", 1);
define("CLIENT", 2);
define("SMTP_HOST", 'smtp.gmail.com');
define('MAIL_USERNAME', 'mailer.digitalplazas@gmail.com');
define('MAIL_PASSWORD', 'contra1990');

	$classPath = "../static/class";



define("CORP", "Expert Cryptos Ltd");

require($classPath."/class.user.php");
require($classPath ."/class.transactions.php");
require($classPath ."/mailerClass.php");

?>