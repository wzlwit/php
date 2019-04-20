<?php
	require_once "functions.php";
	
	$row = DB::query(" SELECT * FROM poll_questions");
	
	echo $twig->render("list.html", array("question"=>$row));
?>