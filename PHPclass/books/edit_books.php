<?php
	// Make sure the form is post
	if($_SERVER["REQUEST_METHOD"] == "POST"){	
		$x = 0;
		if(
			!isset($_POST["name"]) ||
			!isset($_POST["author"]) ||
			!isset($_POST["pub_date"]) ||
			!isset($_POST["editor"]) ||
			!isset($_POST["description"])
		){
			echo "Please fill up all the information";
			$x++;
		}else{
		if(empty($_POST["name"]) && $_POST["name"] != "0"){
			echo "Please enter a valid name<br/>";
			$x++;
		}
		if(empty($_POST["author"]) && $_POST["author"] != "0"){
			echo "Please enter a valid author<br/>";
			$x++;
		}
		if(empty($_POST["pub_date"])){
			echo "Please enter a valid publication date<br/>";
			$x++;
		}
		if(empty($_POST["editor"]) && $_POST["editor"] != "0"){
			echo "Please enter a valid editor<br/>";
			$x++;
		}
		if(empty($_POST["description"]) && $_POST["description"] != "0"){
			echo "Please enter a description<br/>";
			$x++;
		}
		}

		//Make sure date is between 2018 and 1970
		if($_POST["pub_date"] < 1970 || $_POST["pub_date"] > date("Y")){
			echo "Please enter a valid date";
		}
		
		if($x == 0){
		require_once("meekro/meekrodb.2.3.class.php");
		DB::$user = "root";
		DB::$password = "";
		DB::$dbName = "library";
		
		// insert data into books
		DB::insert("books", 
		array(
			  "description" => $_POST["description"],
			  "title" => $_POST["name"],
			  "author" => $_POST["author"],
			  "publication year" => $_POST["pub_date"],
			  "editor" => $_POST["editor"]
			 )
		);
		header("location: list_books.php");
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Books</title>
	</head>
	<body>
		<form action="" method="post">
			Name: <input type="text" name="name" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $_POST["name"]; ?>"/><br/>
			Author: <input type="text" name="author" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $_POST["author"]; ?>"/><br/>
			Year of publication: <select name="pub_date" >
									<?php for($y = date("Y"); $y >= 1970; $y--){ ?>
									<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
									<?php } ?> 
								 </select><br/>
			Editor: <input type="text" name="editor" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $_POST["editor"]; ?>"/><br/>
			Description: <textarea name="description"><?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $_POST["description"]; ?></textarea><br/>
			<input type="submit" value="submit"/>
		</form>
	</body>
</html>