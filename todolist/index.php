<?php
 // index.php

require './functions.php';

//* initiate f3
$f3 = Base::instance();

// *twig
$loader = new \Twig\Loader\FilesystemLoader('Views'); //indicate the folder to load the pages for View, if not exist, create one
$twig = new \Twig\Environment($loader);
// set so we can use twig everywhere we have access to fatfree
$f3->set('twig', $twig);

// configuration
/** Moved to config.ini
 * $f3->set("AUTOLOAD", "Controllers/");
 * $f3->set("DEBUG", 3); 
 */
$f3->config("config.ini");


// * routing

$f3->route("GET /", "Items->listing");

$f3->route("GET /add", "Items->create");
$f3->route("POST /add", "Items->create_post");

$f3->route("POST /complete", "Items->complete");
$f3->route("POST /delete", "Items->delete");


$f3->route("GET /login", "Users->login");
$f3->route("POST /login", "Users->login_post");

$f3->route("GET /logout", "Users->logout");




// !execute. f3->run() must be the last statement
$f3->run();

?>
<!-- --> 