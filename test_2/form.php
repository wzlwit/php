<?php
// Connect to functions.php
require_once "functions.php";


/*$formError = false;
$date = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('America/Toronto'));
// check if post method is used
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["task"]) && $_POST["task"] != ""){
  //  DB::query("UPDATE todo_items SET name = %s, description = %s, completed = 0, date_added = %t, ip_address = %s", $_POST['task'], $_POST['descript'], date(), $_SERVER['REMOTE_ADDR']);
    DB::insert('todo_items', array(
              'name' => $_POST["task"],
              'description' => $_POST['descript'],
              'completed' => '0',
              'date_added' => $date,
              'ip_address' => $_SERVER['REMOTE_ADDR']
              ));
  }else{
    $formError = true;
  }
}*/

echo $twig->render("form.htm", array("error"=>$formError));
 ?>
