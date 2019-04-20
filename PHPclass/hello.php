<!DOCTYPE html>
<html>
	<head>
		<title>Hello World!</title>
	</head>
	<body>
		<?php
			error_reporting(E_ALL);
			
			$name = "Joseph";
			echo $name;
			print $name;
			echo "<br/>";
			echo "<h2>".$name."</h2>"; // with echo, you can use comma instead of period to concatenate
			echo "<h3>", "My name is ", $name , "</h3>";
			print "<h2>".$name."</h2>"; // print cannot use comma
			
			// Double quotes can contain variable name
			// Single quotes will treat variable names as a literal string
			
			echo "<h2>$name</h2>";
			echo '<h2>$name</h2>'; 
			
			echo "<hr/>";
			
			// strlen() counts the length of a string
			
			$length =  strlen($name);
			
			echo "Hello my name is ". $name . " and that is ". $length . " characters long.";			
			
			// htmlentities() converts special characters for html to display correctly
			// ucfirst() turns the first word of the string to uppercase
			// strtoupper() converts all to uppercase
			
			echo "<hr/>";
			
			// round(variable, number of decimal) rounds the number
			$float = 25.56789234;
			
			echo round($float, 3);
			
		?>
	</body>
</html>
