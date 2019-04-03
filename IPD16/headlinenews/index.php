<?php

include_once('./includes/function.php');
// use Monolog\logger;
// use Monolog\Handler\StreamHandler;

$message='';

//echo $_POST['email'];
echo $_SESSION['user'];
//echo $twig->render('./loginForm.html',['form_action'=>$_SERVER['PHP_SELF']]);
echo $twig->render('./news.html');
?>