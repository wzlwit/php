<?php
// include composers autoloader
require_once("vendor/autoload.php");

// include template engine
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

//MEEKRO - database variables
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'test2_db';

// Start session_cache_expire
session_start();

//check if session logged_in
$logged_in = false;
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true){
  $logged_in = true;
  $twig->addGlobal("linked", $logged_in);
}

// Form for footer and form page
$formError = false;
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
}

?>
