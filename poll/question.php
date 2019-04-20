<?php
	require_once "functions.php";
	
	// check the GET for question id
	if(isset($_GET["id"]) && is_numeric($_GET["id"])){
		$question_id = $_GET["id"];
	}else{
		header("Location: index.php");
	}
	
	$row = DB::queryFirstRow(" SELECT * FROM poll_questions WHERE id=%i", $question_id);
	
	$row_answer = DB::query("SELECT * FROM poll_answers WHERE question_id = %i", $question_id);
	
	// chrck POST
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST["answer"]) && is_numeric($_POST["answer"])){
			// update db
			 DB::query("UPDATE poll_answers SET total=total+1 WHERE id=%i", $_POST["answer"]);
			
			header("Location:results.php?answered=yes");
		}else{
			// show error
			$error = "No answer was found.";		
		}
	}
	
	echo $twig->render("question.html", array("db_question"=>$row, "db_answers"=>$row_answer, "error"=>$error));
?>