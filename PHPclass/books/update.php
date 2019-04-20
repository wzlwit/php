<?php
	$db = new mysqli("localhost", "root", "", "books");
	if($db->connect_errno > 0){
		die("Connection Failed: ". $db->connect_errno);
	}
	// fetch the user that was sent in the URL
	// display the user's current information in the form	
	// submit form	
	// if request method is post
		// save(UPDATE) that same user's information in the database
		//redirect userback to create.php
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(!filter_var($_POST['memberID'], FILTER_VALIDATE_INT) || $_POST['memberID'] <= 0 || $_POST['memberID'] > $db->query("SELECT count(ID) FROM members")){
			echo "Please enter a valid Member ID.";
		}else{
			$id = $_POST['memberID'];
			$name = $db->real_escape_string(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
			$password = $db->real_escape_string(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$email = $db->real_escape_string(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
			}else{
				echo "Please enter a valid email";
			}
			$rowToUpdate =  "UPDATE members SET name = '". $name. "', email = '". $email. "', password = '". $password. "'
			WHERE ID =  '". $id."'";
			$updateMember = $db->query($rowToUpdate);
			if(!updateMember){
				die("Query failed: ". $db->error);
			}else{
				echo "Member has been updated.";
				header('Location: create.php?user=new');
			}
		}
	}
	$db->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Update A Member</title>
	</head>
	<body>
	<h1>Update member info</h1>
		<form action="" method="POST">
			MemberID: <input type="text" name="memberID"><br/>
			Name(new): <input type="text" name="name"><br/>
			Email(new): <input type="email" name="email"><br/>
			Password(new): <input type="text" name="password"><br/>
			<input type="submit" value="update"><br/>
		</form>
	</body>
</html>