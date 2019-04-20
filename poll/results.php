<?php
	require_once "functions.php";
	
	$answers = array();
	$answered = "";
	$done = false;
	if(isset($_GET["answered"])){
		$done = true;
	}
	
	if($logged_in){
	//$data = DB::query("SELECT * FROM poll_answers");
	$quest = DB::query("SELECT * FROM poll_questions");
	foreach($quest as $q){
		
		$data = DB::query("SELECT * FROM poll_answers WHERE question_id = %i", $q["id"]);
		$answers[] = array("question"=>$q["question"], "answers"=>$data);  //square brackets after variable pushes another value for an array
	}
	}
	
	//$get = isset($_GET);
	
	echo $twig->render("results.html", array("answer"=>$answers, "done"=>$done));
	
	
?>