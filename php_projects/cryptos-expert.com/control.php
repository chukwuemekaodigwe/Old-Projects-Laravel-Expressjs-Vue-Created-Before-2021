<?php
ini_set("display_errors", TRUE);
//ini_set("allow_url_fopen", 1);   Rewrites the php.ini for able to fopen to work {(api)
date_default_timezone_set("Africa/Lagos");
/*
define("DB_DSN", "mysql:host=localhost;dbname=u0563892_default;charset=utf8mb4");
define("DB_USERNAME", "u0563892_default");
define("DB_PASSWORD", "rvSX_0QG");
*/

//8 Home***
define("DB_DSN", "mysql:host=localhost;dbname=cryptozone;charset=utf8mb4");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

$Ex = array(PDO::ATTR_EMULATE_PREPARES => FALSE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$_SESSION['dbErr'] = $Ex;

	$classPath = "static/class";


define("CORP", "Expert Cryptos Ltd");

require($classPath."/class.user.php");
require($classPath ."/class.transactions.php");
require($classPath ."/mailerClass.php");

?>