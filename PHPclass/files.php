<?php
	//open a file
	$handler = fopen("data.txt", "r+");
	//echo fread($handler, filesize("data.txt"));
	//fwrite($handler, "this is added");
	
	echo fgets($handler). "<br/>";
		 echo "<hr/>";
		 
	while(!feof($handler)){   // feof end of file
		echo fgets($handler)."<br/>";
	}
	
	//unlink() will delete a file
	
	fclose($handler);
?>