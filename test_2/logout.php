<?php
	//start session
	session_start();

	$_SESSION = array(); // to remove all values set for $_SESSION;

	session_destroy();

	header("Location:index.php");

?>
