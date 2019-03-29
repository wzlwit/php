<?php

require_once("meekro/meekrodb.2.3.class.php");
DB::$user = "root";
DB::$password = "";
DB::$dbName = "library";

$error = [];
$min_year = 1950;
$title = "Create a book";

$id = $name = $author = $year_pub = $editor = $description = "";

if ( $_SERVER['REQUEST_METHOD'] == "POST"){
	$id = isset($_POST['id']) ? $_POST['id'] : "";
	$name = isset($_POST['name']) ? $_POST['name'] : "";
	$author = isset($_POST['author']) ? $_POST['author'] : "";
	$year_pub = isset($_POST['year_pub']) ? $_POST['year_pub'] : "";
	$editor = isset($_POST['editor']) ? $_POST['editor'] : "";
	$description = isset($_POST['description']) ? $_POST['description'] : "";

	//validate all the date received
	if ( !isset($_POST['name']) ||
				!isset($_POST['author']) ||
				!isset($_POST['year_pub']) ||
				!isset($_POST['editor']) ||
				!isset($_POST['description'])  ){
		$error[] = "A field is missing, please try again";
	}else{
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
	if (empty($error)){
		$vars = array(
			'title' => $name,
			'author' => $author,
			'pub_year' => $year_pub,
			'editor' => $editor,
			'description' => $description
		);
    if (isset($_POST['id']) && is_numeric($_POST['id']))
      $vars['id'] = $_POST['id'];

		//insert data into books table
		DB::insertUpdate("books", $vars);
		//updated so different redirection
		$action = (isset($_POST['id']) && is_numeric($_POST['id'])) ? "updated" : "new";

		header("Location: books.php?" . $action . "=". htmlentities($name));

	}
}else { //GET method
	if (isset($_GET['book']) && is_numeric($_GET['book'])){
		$book =  DB::queryFirstRow("SELECT * FROM books WHERE id=%i", $_GET['book']);
		if (DB::count() != 0){

			if (isset($_GET['book']) && $_GET['action'] == "update"){
				$id = $book['id'];
				$name = $book['title'];
				$author = $book['author'];
				$year_pub = $book['pub_year'];
				$editor = $book['editor'];
				$description = $book['description'];
				$title = "Edit Book";
			}elseif (isset($_GET['book']) && $_GET['action']=="delete"){
				 DB::delete('books', "id=%i", $_GET['book']);
				 header("Location: books.php?removed=". htmlentities($book['title']));
			}
		}else{
			//no book was found in database
			header("Location: books.php");

		}


	}

}

?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="css/style.css" type="text/css"> </head>

<body>
  <div class="py-2 text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="display-3 text-capitalize">My Library</h1>
					<ul class="nav">
						<li class="nav-item">
        			<a class="nav-link" href="index.php">Home</a>
        		</li>
						<li class="nav-item">
							<a class="nav-link" href="edit_books.php">Create Book</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="books.php">List Books</a>
						</li>
						<li class="nav-item">
							<a href="members.php#create" class="nav-link">Create Member</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="members.php#list">List Members</a>
						</li>
					</ul>
        </div>
      </div>
    </div>
  </div>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2><?php echo $title; ?></h2>
          <hr>
          <?php if (!empty($error)){
            echo "<div class='alert alert-danger'><strong>An error has occured!!!</strong><br />";
            foreach ($error as $e)
              echo $e."<br />";
            echo "</div>";
          }?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">
          <form action="" method="POST">
            <div class="form-group">
              <label>Book Title</label>
              <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Author</label>
              <input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Year of Publication</label>
              <select class="form-control" name="year_pub" />
            			<option value="">----</option>
            			<?php for ($y = date('Y'); $y>= $min_year	; $y--) { ?>
            				<option value="<?php echo $y; ?>" <?php echo ($y == $year_pub ? "selected" : ""); ?>><?php echo $y; ?></option>
            			<?php } ?>
            		</select>
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Editor</label>
              <input type="text" class="form-control" name="editor" value="<?php echo $editor; ?>">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" rows="3" name="description"><?php echo $description; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
