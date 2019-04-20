<?php
	// This is going to be my main confidguration get_include_file
	
	// Start session_cache_expire
	session_start();
	
	// include composers autoloader
	require_once("vendor/autoload.php");
	
	// include template engine
	$loader = new Twig_Loader_Filesystem('templates');
	$twig = new Twig_Environment($loader);
	
	// MONOLOG - setup logging
	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;

	// create a log channel
	$log = new Logger('poll');
	$log->pushHandler(new StreamHandler('log_file.log', Logger::DEBUG));

	// add records to the log
	$log->info('The functions page was loaded');
	
	// debug,info,notice,warning,error,critical,alert,emergency <--log levels
	
	//check if session logged_in
	$logged_in = false;
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true){
		$logged_in = true;
		$twig->addGlobal("username", $_SESSION["name"]);
	}
	
	$twig->addGlobal("logged_in", $logged_in); // add gloabsl can be used on html templates
	
	//MEEKRO - database variables
	DB::$user = 'root';
	DB::$password = '';
	DB::$dbName = 'poll_database';
	
	$error = ""; // in case we need to declare error
	
?>