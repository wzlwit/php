<?php
	require_once "functions.php";
	
	// Logic to login user
	// check post method
	/*if($_SERVER["REQUEST_METHOD"] == "post"){
		if(isset($_POST["email"]) && isset($_POST["REQUEST_METHOD"]) ){
			$email = $_POST["email"];
			$password = md5($_POST["password"]);
		}else{
			header("Location:login.php")
		}
		
		$user = DB::query("SELECT email, password FROM poll_users WHERE email=i% AND password=i%", $email, $password)
		
	}*/
	
	
	$email = "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!isset($_POST["email"]) || $_POST["email"] == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			$error = "Invalid email";
		}else if(!isset($_POST["password"]) || $_POST["password"] == ""){
				$error = "Invalid password";
		}else{
			$result = DB::queryFirstRow("SELECT * FROM poll_users WHERE email=%s AND password=%s", $_POST["email"], md5($_POST["password"]));
		
			if(is_null($result)){
				$error = "Login unsuccesful";
			}else{
				// set session
				$_SESSION["logged_in"] = true;
				$_SESSION["name"] = $result["name"];
				
				header("Location: index.php");
			}
		}
	}
	
	
	echo $twig->render("login.html", array("error"=>$error));
?>