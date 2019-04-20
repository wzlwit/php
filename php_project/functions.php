<?php
require_once ("vendor/autoload.php");

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

/*
// MEEKRO - database variables
DB::$user = '';
DB::$password = '';
DB::$dbName = '';

$error = ""; // in case we have to declare errors
*/
?>