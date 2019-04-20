<?php
		require_once("meekro/meekrodb.2.3.class.php");
		DB::$user = "root";
		DB::$password = "";
		DB::$dbName = "library";
		
		$data = DB::query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Listing</title>
	</head>
	<body>
		<h1>List of books</h1>
		<table>
			<tr>
				<th>Title</th>
				<th>Author</th>
				<th>Publication year</th>
				<th>Editor</th>
				<th>Description</th>
			</tr>
			<?php foreach($data as $row){ ?>
			<tr>
				<td><?php echo $row["title"]; ?></td>
				<td><?php echo $row["author"]; ?></td>
				<td><?php echo $row["publication year"]; ?></td>
				<td><?php echo $row["editor"]; ?></td>
				<td><?php echo $row["description"]; ?></td>
			</tr>
			<?php } ?>			
		</table>
	</body>
</html>