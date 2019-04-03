
<?php

require('../vendor/autoload.php');

session_start();


$continents=  array('American','Asia','Europe','Africa','Australia');
DB::$user='ipd';
DB::$password='ipdipd';
DB::$dbName='ipd16';

//twig configuration

$loader = new \Twig\Loader\FilesystemLoader('template');

$twig = new \Twig\Environment($loader);


function br()
{
  echo '<br>';

}

function pr($arr)
{
    echo '<pre>';
    print_r ($arr);
    echo '</pre>';
    echo '<hr>';
}

function displayAlert($message, $class="primary"){
 echo "<div class='alert alert-" . $class . "'>" . $message . "</div>";
}

function is_login(){

if(isset($_SESSION['user'])&&$_SESSION['user']!='')
 {
return true;}
 else
 return false;
}

function is_admin(){

  if(isset($_SESSION['type'])&&$_SESSION['type']=='admin')
   return true;
   else
   return false;
  
  }

$twig->addGlobal('is_logged_in',is_login());
$twig->addGlobal('is_admin',is_admin());
$twig->addGlobal('session',$_SESSION);
$twig->addGlobal('continents',$continents);
?>