<?php

$db	= new mysqli("localhost", "root", "", "library");
if ( $db->connect_errno > 0){
	die("Connection Failed: " . $db->connect_error);
}

$error = NULL;

if ( $_SERVER['REQUEST_METHOD'] == "POST"){
	//validate all the date received
	if ( empty($_POST['name']) ||
				empty($_POST['email']) ||
				empty($_POST['password']) ||
				empty($_POST['ID']) ||
				!is_numeric($_POST['ID']) ||
				!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
		echo "There was an error, please try again";
	}else{

		$ID = $db->real_escape_string(filter_var($_POST['ID'], FILTER_SANITIZE_NUMBER_INT));
		$name = $db->real_escape_string(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
		$password = $db->real_escape_string(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$email = $db->real_escape_string(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

		$sql = "UPDATE members SET name = '" . $name . "', email = '" . $email . "', password = '" . $password . "' WHERE ID =  '" . $ID . "' LIMIT 1";

		//insert into the database
		$results = $db->query($sql);
		if (!$results){
			die("Query failed: " . $db->error);
		}

		header('Location: members.php?updated='. $name);
	}
}else if ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (!isset($_GET['user']) || !is_numeric($_GET['user'])){
		$error = "Unable to update this user";
	}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
		if ( !$db->query("DELETE FROM members WHERE ID = '". $_GET['user'] . "' LIMIT 1")){
			die("Query failed: " . $db->error);
		}
		$name = isset($_GET['name']) ? $_GET['name'] : "Unknonw";
		header('Location: members.php?removed='. $name);
	}
}

$sql = "SELECT * FROM members WHERE ID = " . filter_var($_GET['user'], FILTER_SANITIZE_NUMBER_INT);
$query = $db->query($sql);
if( !$query )
	die("Query failed: " . $db->error);
else if ($query->num_rows != 1)
	$error = "Unable to find requested user";
else
	$info = $query->fetch_assoc();

?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Member</title>
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
          <h2>Edit Member</h2>
          <hr> </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">
        <?php
      		if (!is_null($error)) echo $error;
      		else{ ?>
      			<form action="" method="POST">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $info['name']; ?>">
                <small class="form-text text-muted"></small>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo $info['email']; ?>">
                <small class="form-text text-muted"></small>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $info['password']; ?>">
                <small class="form-text text-muted"></small>
              </div>
              <input type="hidden" name="ID" value="<?php echo $info['ID']; ?>" /><br />
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
