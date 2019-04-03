<?php

// TODO - include functions file
require './includes/functions.php';

$error = [];
$min_year = 1950;
$title = "Create a book";
$book = [];

$id = $name = $author = $year_pub = $editor = $description = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = isset($_POST['id']) ? $_POST['id'] : "";
  $name = isset($_POST['name']) ? $_POST['name'] : "";
  $author = isset($_POST['author']) ? $_POST['author'] : "";
  $year_pub = isset($_POST['year_pub']) ? $_POST['year_pub'] : "";
  $editor = isset($_POST['editor']) ? $_POST['editor'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";

  //validate all the date received
  if (
    !isset($_POST['name']) ||
    !isset($_POST['author']) ||
    !isset($_POST['year_pub']) ||
    !isset($_POST['editor']) ||
    !isset($_POST['description'])
  ) {
    $error[] = "A field is missing, please try again";
  } else {
    if (empty($_POST['name']) && $_POST['name'] != "0")
      $error[] = "Name was left blank, please try again";
    if (empty($_POST['author']) && $_POST['author'] != "0")
      $error[] = "author was left blank, please try again";
    if (!is_numeric($_POST['year_pub']) || $_POST['year_pub'] > date('Y') || $_POST['year_pub'] < $min_year)
      $error[] = "Year of publication is not valid, please try again";
    if (empty($_POST['editor']) && $_POST['editor'] != "0")
      $error[] = "Editor was left blank, please try again";
    if (empty($_POST['description']) && $_POST['description'] != "0")
      $error[] = "Description was left blank, please try again";
  }
  //IF I HAVE NO ERRORS
  if (empty($error)) {

    //TODO - insert data into books table
    $row = array(
      'title' => $name,
      'author' => $author,
      'year' => $year_pub,
      'editor' => $editor,
      'description' => $description
    );
    if ($id == "") {

      DB::insert('books', $row);
    } else {
      //updated so different redirection
      DB::update('books', $row);
    }
    // TODO - redirect user to book listing
    header("location: Books.php");
  }
} else {
  //GET method
  if (isset($_GET['b_id']) && is_numeric($_GET['b_id'])) {
    $book =  DB::queryFirstRow("SELECT * FROM books WHERE id=%i", $_GET['b_id']);
    //if (DB::count() != 0){
    if ($book != null) {
      if (isset($_GET['delete']) && $_GET['delete'] == "1") {
        if (isadmin()) {
          DB::delete('books', "id=%i", $_GET['b_id']);
        }
        header("Location: books.php");
      } else {
        $id = $book['id'];
        $name = $book['title'];
        $author = $book['author'];
        $year_pub = $book['year'];
        $editor = $book['editor'];
        $description = $book['description'];
        $title = "Edit Book";
      }
    } else {
      //no book was found in database
      header("Location: books.php?BOOK-NO-FOUND");
    }
  }
}
echo $twig->render("book_form.html", array("title" => $title, "error" => $error, "book" => $book));
?>
<!-- --> 