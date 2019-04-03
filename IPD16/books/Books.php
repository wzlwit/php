<!DOCTYPE html>
<?php
require './includes/functions.php';

// select the books from our DB
$list = DB::query("SELECT * FROM books");
// pr($list);

// loop and display in the table
// show ttal number of books in library

echo $twig->render("books_list.html", array("books" => $list));

?>
<!--  -->