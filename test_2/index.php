<?php
  // Connect to functions.php
  require_once "functions.php";

  $todo = array();

  // Take all todo_items from the database
  $data = DB::query("SELECT * FROM todo_items");

  // Store each item in $todo array
  foreach($data as $d){
    $todo[] = array("data"=>$d);
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['completed'];

    if(isset($_POST["completed"]) && $_POST['completed'] != ""){
      DB::query("UPDATE todo_items SET completed = 1 WHERE id = %i", $id);
    }

    header("Location:index.php?completed=".$id);
  }

  echo $twig->render("list.htm", array("todo"=>$todo, "error"=>$formError));

 ?>
