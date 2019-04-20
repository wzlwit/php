<?php
	// Super Globals	
	// print_r($_SERVER); <--- gives information
	
	// Time stamp
	date_default_timezone_set("America/Toronto");
	echo date("l F jS G:i e", mktime(10, 5, 27, 10, 31, 2014));
	echo "<hr/>";
	echo time();
	echo "<hr/>";
	
	
	// cookies
	$time = time() + (60 * 60);
	setcookie("Username", "Joseph", $time);
	setcookie("Price", "11.99", $time);
	echo $_COOKIE["Username"]. " ";
	echo $_COOKIE["Price"];
	echo "<hr/>";
	// sessions
	
	// starting a session
	session_start();
	
	$_SESSION["hometown"] = "Montreal";
	print_r($_SESSION);
	
	// session_unset() unsets the sesseion
	// session_destroy() destroys the session
	
?>