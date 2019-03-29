<?php
require_once("vendor/autoload.php");

$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);

$db	= new mysqli("localhost", "root", "", "library");
if ( $db->connect_errno > 0){
	die("Connection Failed: " . $db->connect_error);
}
	// taken from html
       $rent_success = (isset($_GET['book']) && $_GET['book'] == "rented");
// are we using post method
if ( $_SERVER['REQUEST_METHOD'] == "POST"){
	
	//validate all the date received
	if ( !is_numeric($_POST['book_id']) ||
				!is_numeric($_POST['member_id']) ){
		echo "There was an error, please try again";
	}else{
    $book = (int)$_POST['book_id'];
    $member = (int)$_POST['member_id'];

		$sql = "INSERT INTO rented_books (book_id, member_id) VALUES ('" .$book . "', '" . $member ."')";

		//insert into the database
		$results = $db->query($sql);
		if (!$results){
			die("Query failed: " . $db->error);
		}
		header('Location: index.php?book=rented');
	}
}

//fetch listing of all members
$sql = "SELECT ID, name FROM members";
$res_members = $db->query($sql);
if( !$res_members )
	die("Query failed: " . $db->error);

  //fetch listing of all books
  $sql = "SELECT id, title FROM books";
  $res_books = $db->query($sql);
  if( !$res_books )
  	die("Query failed: " . $db->error);

//fetch listing of all books
$sql = "SELECT books.id, books.title AS book, rented_books.time_taken, members.name AS member FROM books, rented_books, members WHERE rented_books.member_id = members.ID AND rented_books.book_id = books.id";
$res_rented = $db->query($sql);
if( !$res_rented )
	die("Query failed: " . $db->error);

	if($res_rented->num_rows == 0){
		$num = "0";
	}else{
		$num = $num = $res_rented->num_rows;
	}
//close the connection
$db->close();

echo $twig->render('index.html', array("members"=>$res_members, "books"=>$res_books, "rentals"=>$res_rented, "success"=>$rent_success, "number"=>$num));

?>