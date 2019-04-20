<?php
	// are we using post method?
	// validate all the data recieved
	// insert into the database
		// connect to the database
		// insert
		// close the connection
		$db = new mysqli("localhost", "root", "", "books");
				if($db->connect_errno > 0){
					die("Connection Failed: ". $db->connect_errno);
				}
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
				echo "There as an error. Please try again";
			}else{
				//echo "save to db";
				//echo "<br/>";
				// Check

				$name = $db->real_escape_string(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
				$password = $db->real_escape_string(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
				$email = $db->real_escape_string(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
				$sql = "INSERT INTO members (name, email, password) VALUES ('". $name. "','". $email. "','". $password. "')";
				
				
				// insert into database
				$results = $db->query($sql);
				if(!$results){
					die("Query failed: ". $db->error);
				}
				header('Location: create.php?user=new');
			}
		}
		// Fetch listing of all members
		$res_members = $db->query("SELECT * FROM members");
		if(!$res_members){
		die("Query failed: ". $db->error);
		}
		
		// delete users
		if(isset($_GET["delete"])){
			$deleteRow = $db->query("DELETE FROM members WHERE ID =". $_GET["delete"]);
			if(!$deleteRow){
				echo "An error has occured. Unable to delete member.";
			}
			header('Location: create.php?user=new');
		}
		$db->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Create Users</title>
	</head>
	<body>
		<h1>Create a new User</h1>
		<form action="#" method="POST">
			Name: <input type="text" name="name" /> <br/>
			Email: <input type="email" name="email" /> <br/>
			Password: <input type="password" name="password" /> <br/>
			<br/>
			<input type="submit" value="create"/>
		</form>
		<h2>List of our members</h2>
		<table>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Password</th>
				<th></th>
			</tr>
			<?php while($row = $res_members->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $row['ID']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['password']; ?></td>
				<td>
					<a href="update.php?user=<?php echo $row['ID'];?>">Update</a>
					<a href="create.php?delete=<?php echo $row['ID'];?>">Delete</a>
				</td>
			</tr>
			<?php } // end of while loop ?>
		</table>
	</body>
</html>