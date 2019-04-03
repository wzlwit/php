<?php
date_default_timezone_set("America/Toronto");
echo time() . "<br>";
echo date('d/M/Y H:i', time()) . "<br>";

$time = mktime(17, 5, 30);

$exp_time = time() + 60 * 10;
// $exp_time = time() - 60 * 10;

// *to kill a cookie, set expire date earlier than current time
// cookies
setcookie("username", "Step", $exp_time);
echo '<br>';
// echo $_COOKIE;

// read a cookie;
echo $_COOKIE['username'];

// !session
session_start();
$_SESSION['user'] = "WZL";
echo "<br>";

// session_unset();
session_destroy();
echo session_id();
echo $_SESSION['user'] = "WZL";
?>
<!--  --> 