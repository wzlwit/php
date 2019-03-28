<?php    // load composer

require_once("vendor/autoload.php");
date_default_timezone_set("America/New_York");

// *start session
session_start();

//* initiate f3
$f3 = Base::instance();

// *twig
$loader = new \Twig\Loader\FilesystemLoader('Views'); //indicate the folder to load the pages for View, if not exist, create one
$twig = new \Twig\Environment($loader);
// set so we can use twig everywhere we have access to fatfree

$f3->set('twig', $twig);

function islogin()
{
    if (isset($_SESSION['u_id']) && $_SESSION['u_id'] != "" && is_numeric($_SESSION['u_id'])) {
        return true;
    } else return false;
}

function pr($arr)
{
    // echo "<pre>";
    print_r($arr);
    // echo "<pre>";
    echo "<br>";
}

// ! pass in using fat free way
$f3->set("islogin",islogin());
$f3->get('twig')->addGlobal("session", $_SESSION);

// $f3->get('twig')->addGlobal("islogin", islogin());
// $twig->addGlobal("completed", completed());
 