<?php
	// constants
	define("AUTHOR", "Joseph"); // Declares a constant
	define("CONVERT_MPH", 1.6);
	echo AUTHOR;
	echo "<hr/>";
	echo CONVERT_MPH;
	
	echo "<hr/>";
	
	// array of provinces 
	$provinces = array("Ontario", "Quebec", "Manitoba", "Alberta");
	
	echo count($provinces); // counts the number of item inside the array
	
	echo "<hr/>";
	
	print_r($provinces); // prints all the items and their corresponding index inside an array
	
	echo "<hr/>";
	
	asort($provinces); // sorts the value but keeps the assigned index
	print_r($provinces);
	
	echo "<hr/>";
	
	krsort($provinces);
	print_r($provinces);
	
	echo "<hr/>";
	
	$canada = "nova scotia, new brunswick, PEI";
	
	$canada = explode(",", $canada); // Creates an array out of a string
	
	print_r($canada);
	
	echo "<hr/>";
	
	$canada = implode(",", $canada); // Creates a string out of an array
	
	print_r($canada);
	
	echo "<hr/>";
	
	$name = "John";
	$age = 25;
	$city = "Montreal";
	
	$person = compact("name", "age", "city"); // Creates an array out of multiple declared variables
	print_r($person);
	
	echo "<hr/>";
	
	// Create a function
	function name_of_function($x){
		// sum of x + 5
		return $x + 5;
	}
	
	$value = name_of_function(5);
	echo $value. " ";
	echo name_of_function(3);
	
	echo "<hr/>";
	
	$y = 12;
	
	function global_var(){
		global $y; // takes the variable outside of this function and use it
		
		$y = 5;
		
		return $y;
	}
	
	echo $y. " ";
	global_var();
	echo $y;
	
	echo "<hr/>";
	
	function static_var(){
		static $x = 0; // static keeps the value of the variable
		$x++;
		echo $x;
	}
	
	static_var();
	static_var();
	static_var();
	static_var();
	
	echo "<hr/>";
	
	$w;
	
	function pass_by_reference(&$x){ // add & before the $varaible to initiate pass by reference
		$y = 5;
		
		$x = $x + $y;
	}
	
	pass_by_reference($w);	//whatever happens to $x inside the function is applied to $w
	echo $w. " ";
	pass_by_reference($w);
	echo $w. " ";
	pass_by_reference($w);
	echo $w. " ";
	pass_by_reference($w);
	echo $w. " ";
	
	echo "<hr/>";
	
	// Loops
	$loopArray = array("John", 25, "Montreal");
	
	foreach($loopArray as $index => $value){
		echo $value. " has the index ". $index. "<br/>";
	}
	
	// loop key words 
	// continue will skip the next lines in the loop and start the next iteration
	// break will stop the loop
	
	echo "<hr/>";
	
	// sadas
	
	//include(""); // will keep running even if file is not available(gives warning)
	//require("filename"); //	code will now work if file is not found
	//include_once("filename"); // once ensures that the file is never added more than once
	//require_once("filename";
?>