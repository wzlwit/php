<?php
//reset session variable
//todo - remove all cookies
//redirect to login

session_start();
session_unset();
session_destroy();

header('location:index.php');

?>