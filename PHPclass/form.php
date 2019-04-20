<!DOCTYPE html>
<html>
	<head>
		<title>Form - Super Global</title>
	</head>
	<body>
		<?php
			echo "<pre>";
			if($_SERVER['REQUEST_METHOD'] == "POST"){
					echo "Form was submitted by post <br/> ";
					print_r($_POST);
			}
			echo "<pre/>";
			echo "<br/>";
			if(!empty($_POST["first_name"])){
				echo "HELLO ".$_POST["first_name"];
			}
				echo "<br/>";
			if(!is_numeric($_POST["last_name"])){
				echo "Last Name is a string";
			}
				echo "<br/>";
			if(isset($_POST["foods"])){
				echo "We have the food you like!";
			}
			echo "<br/>";
			// sanetize email
			$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);  // FILTER_VAlIDATE_EMAIL will return a boolean result
			echo $email;
		/*	print_r($_GET);
			echo "<br/>";
			print_r($_POST);
			echo "<br/>";
			print_r($_REQUEST);*/		
			
			print_r($_FILES);
			// move_uploaded_file() moves uploaded file to a destination in your server
		?>
		<form action="#" method="post" enctype="multipart/form-data">
			<label for="firstName">First Name: </label>
			<input id="firstName" type="text" name="first_name" />
			<br/>
			<label for="lastName">Last Name: </label>
			<input id="lastName" type="text" name="last_name" />
			<br/>
			<label for="address">Address</label>
			<textarea id="address" name="address"></textarea>
			<br/>
			<label for="check">Happy with this service?</label>
			<input type="checkbox" name="satisafction"/>
			<br/>
			<label for="food">Select food</label>
			<select id="food" name="foods[]" multiple>   <!-- square brackets makes foods an array -->
				<option value="carrots">Carrots</option>
				<option value="cucumber">Cucumber</option>
				<option value="Apple">Apple</option>
				<option value="pear">Pear</option>
			</select>
			<br/>
			<label for="blue">Blue</label>
			<input type="checkbox" name="color[]" value="blue"/>
			<br/>
			<label for="blue">Red</label>
			<input type="checkbox" name="color[]" value="red"/>
			<br/>
			<label for="blue">Yellow</label>
			<input type="checkbox" name="color[]" value="yellow"/>
			<br/>
			<label for="email">Email</label>
			<input id="email" type="text" name="email" />
			<br/>
			<label for="photo">Choose photo</label>
			<input id="photo" type="file" name="photo"/>
			<br/>
			<input type="submit"/>
	</body>
</html>