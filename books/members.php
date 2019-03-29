<?php

$db	= new mysqli("localhost", "root", "", "library");
if ( $db->connect_errno > 0){
	die("Connection Failed: " . $db->connect_error);
}
// are we using post method
if ( $_SERVER['REQUEST_METHOD'] == "POST"){
	//validate all the date received
	if ( empty($_POST['name']) ||
				empty($_POST['email']) ||
				empty($_POST['password']) ||
				!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
		echo "There was an error, please try again";
	}else{
		$name = $db->real_escape_string(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
		$password = $db->real_escape_string(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$email = $db->real_escape_string(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

		$sql = "INSERT INTO members (name, email, password) VALUES ('" .$name . "', '" . $email . "', '" .$password ."')";

		//insert into the database
		$results = $db->query($sql);
		if (!$results){
			die("Query failed: " . $db->error);
		}
    header('Location: members.php?user='. $name);
	}
}

//fetch listing of all members
$sql = "SELECT * FROM members";
$res_members = $db->query($sql);
if( !$res_members )
die("Query failed: " . $db->error);

//close the connection
$db->close();

?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Members</title>
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
  <div class="py-4"><a name="create"></a>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Create a member</h2>
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">
          <form action="" method="POST">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password">
              <small class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="py-4"><a name="list"></a>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>List of members</h2>
          <hr>
          <?php if (isset($_GET['user'])){
        		echo "<div class='alert alert-success'><strong>CONGRATULATIONS ". $_GET['user'] . "</strong></div>";
          }else if (isset($_GET['updated'])){
        		echo "<div class='alert alert-secondary'><strong>Member Updated ". $_GET['updated'] . "</strong></div>";
          }else if (isset($_GET['removed'])){
        		echo "<div class='alert alert-warning'><strong>Member Removed ". $_GET['removed'] . "</strong></div>";
        	} ?>
          <div class="table-responsive col-md-12">
            <table class="table table-hover table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
            			<th>Name</th>
            			<th>Email</th>
            			<th>Password</th>
            			<th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php while($row = $res_members->fetch_assoc()){ ?>
              			<tr>
              				<td><?php echo $row['ID']; ?></td>
              				<td><?php echo $row['name']; ?></td>
              				<td><?php echo $row['email']; ?></td>
              				<td><?php echo $row['password']; ?></td>
              				<td>
              					<a href="edit_members.php?user=<?php echo $row['ID']; ?>">Update</a> |
              					<a href="edit_members.php?action=delete&user=<?php echo $row['ID']; ?>&name=<?php echo $row['name']; ?>">Delete</a>
              				</td>
              			</tr>
              		<?php } //end of while loop ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-right">There are <?php echo $res_members->num_rows; ?> members</p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
