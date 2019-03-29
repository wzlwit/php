<?php
require_once("vendor/autoload.php");

$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);

require_once("meekro/meekrodb.2.3.class.php");
DB::$user = "root";
DB::$password = "";
DB::$dbName = "library";

$books = DB::query("SELECT * from books");

echo $twig->render("books.html");

if (isset($_GET['new'])){
        		echo "<div class='alert alert-success'><strong>CONGRATULATIONS ". $_GET['new'] . "</strong></div>";
          }else if (isset($_GET['updated'])){
        		echo "<div class='alert alert-secondary'><strong>Book Updated ". $_GET['updated'] . "</strong></div>";
          }else if (isset($_GET['removed'])){
        		echo "<div class='alert alert-warning'><strong>Book Removed ". $_GET['removed'] . "</strong></div>";
          }

?>