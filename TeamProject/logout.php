<?php //index.php
require_once "functions.php";

//echo $twig->render("login.html");


		//set session variables

		session_start();
		$_SESSION = array();
		session_destroy();

		//header("Location: results");
		header("Location: index.php");
	
                                    
?>
