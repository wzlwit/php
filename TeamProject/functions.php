<?php
session_start();
ob_start();

require_once ("vendor/autoload.php");

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

//MONOLOG - setup logging
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//check if session logged_in
$logged_in = false;

if(isset($_SESSION['cart']))
	$arr = $_SESSION['cart'];

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	//we know that user is logged in
	$logged_in = true;
	$twig->addGlobal("user_name", $_SESSION['FirstName']);
	if(isset($_SESSION['UserId']))
	$twig->addGlobal("user_id", $_SESSION['UserId']);
	$twig->addGlobal("loggedin", $logged_in);
}

$twig->addGlobal("logged_in", $logged_in);
// MEEKRO - database variables

DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'bbshop';

?>