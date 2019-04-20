<?php
// Connect to functions.php
require_once "functions.php";
$error = false;
//check POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!isset($_POST["username"]) || $_POST["username"] == ""){
    $error = true;
  }else if(!isset($_POST["password"]) || $_POST["password"] == ""){
    $error = true;
  }else{
    $user = DB::queryFirstRow("SELECT * FROM todo_users WHERE username = %s AND password = %s", $_POST["username"], md5($_POST["password"]));

    if(is_null($user)){
      $error = true;
    }else{
      $_SESSION["logged_in"] = true;
      header("Location: index.php");
    }
  }
}

echo $twig->render("login.htm", array("error"=>$formError, "loginError"=>$error));
 ?>
