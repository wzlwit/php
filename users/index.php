<?php
 // index.php

// load composer
require_once("vendor/autoload.php");

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
 * 
 * */
$f3->config("config.ini");


// routes
// $f3->route("GET /", function(){echo 'hello world';});
$f3->route("GET /", "Pages->homepage");
$f3->route("GET /about", "Pages->about");
$f3->route("GET /temp", "Pages->about");

$f3->route("GET /members", "Users->listing");

// $f3->route("GET /members/create", "Users->create");
$f3->route("GET @member_create: /members/create", "Users->create"); //* without AUTOLOAD, all the controllers must be in the same folder as index.php
$f3->route("POST /members/create", "Users->create_post");
// $f3->route("POST /members/create_post", "Users->create_post"); //if form_action ='members/create_post'

$f3->route("GET /members/update/@id", "Users->update");

$f3->route("POST /members/update/@id", "Users->update_post");

$f3->route("GET /members/delete/@id", "Users->delete");


// !execute. f3->run() must be the last statement
$f3->run();

?>
<!-- --> 