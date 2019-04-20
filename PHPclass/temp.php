<!DOCTYPE hrml>
<html>
	<head>
		<title>Temperature Converter</title>
	</head>
	<body>
		<form action="#" method="post">
			<label for="celcius">Celcius</label>
			<input id="celcius" name="celcius" type="text"/>
			<label for="celResult"> To Fahrenheit</label>
			<input id="celResult" type="text" name="fah" readonly />
			<br/>
			<label for="fahrenheit">Fahrenheit</label>
			<input id="fahrenheit" name="fahrenheit" type="text"/>
			<br/>
			<input type="submit">
		</form>
		<?php
			$celcius;
			$fahrenheit;
			if(isset($_POST["celcius"])){
				if(!is_numeric($_POST["celcius"])){
					echo "Please enter a valid number";
				}
				else{
				$fahrenheit = $_POST["celcius"] * 1.8 + 32;
				echo $_POST["celcius"]. " celcius is ". $fahrenheit. " in fahrenheit.";
				}
			}
			echo "<br/>";
			if(isset($_POST["fahrenheit"])){
				if(!is_numeric($_POST["fahrenheit"])){
					echo "Please enter a valid number";
				}
				else{
				$celcius = ($_POST["fahrenheit"]-32) / 1.8;
				echo $_POST["fahrenheit"]. " fahrenheit is ". $celcius. " in celcius.";
				}
			}			
		?>
	</body>
</html>