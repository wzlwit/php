<?php

require_once "functions.php";

$error = $result_search = $sql_insert = "";
$firstname=$lastname=$inputEmail4=$inputAddress=$inputAddress2=$inputCity=$inputState=$inputZip=$country ="";
// are we using post method
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	//echo "Form was submitted";
	
	//if ucwords($_POST['holiday']) != (Valentine’s Day ||  Mother’s Day || Canada Day || Thanksgiving || Halloween )
	
		
	// validate all the data to save new task received
	
	// validate all the data to save new task received
	if (empty($_POST['firstname']) ||
		empty($_POST['lastname']) ||
		empty($_POST['inputEmail4']) ||
		empty($_POST['inputPassword4']) ||
		empty($_POST['confirm']) ||
		empty($_POST['inputAddress']) ||
		empty($_POST['inputCity']) ||
		empty($_POST['inputState']) ||
		empty($_POST['inputZip']) ||
		empty($_POST['country'])){
	
			$error = "Fill-in the form completely!";
		}else{
			
			// all letters lower case just first upper case
			$firstname = ucwords(strtolower(filter_var($_POST['firstname'], FILTER_SANITIZE_STRING)));
			$lastname = ucwords(strtolower(filter_var($_POST['lastname'], FILTER_SANITIZE_STRING)));
			
			$inputEmail4 = strtolower(filter_var($_POST['inputEmail4'], FILTER_SANITIZE_EMAIL));
			$inputPassword4 = $_POST['inputPassword4'];
			$confirm = $_POST['confirm'];
			$inputAddress = (filter_var($_POST['inputAddress'], FILTER_SANITIZE_STRING));
			$inputAddress2 = (filter_var($_POST['inputAddress2'], FILTER_SANITIZE_STRING));
			$inputCity = ucwords(filter_var($_POST['inputCity'], FILTER_SANITIZE_STRING));
			$inputState = ucwords(filter_var($_POST['inputState'], FILTER_SANITIZE_STRING));
			$country = ucwords(filter_var($_POST['country'], FILTER_SANITIZE_STRING));
			
			$inputZip = (filter_var($_POST['inputZip'], FILTER_SANITIZE_STRING));
			
			// remove everything from ZIP or POST code execpt letter and number and Uppercase
			$inputZip = strtoupper(trim(preg_replace('/[^0-9a-zA-Z_]/',"", $inputZip)));


			if ($inputPassword4 == $confirm){
				
				$result_search = DB::queryFirstRow("SELECT * from tblUser
										WHERE email=%s",
										$inputEmail4);
										
				//$result_search= DB::query($sql_search ,$inputEmail4);						
				
				if (is_null($result_search)){
					
					$inputPassword4 =md5($inputPassword4);
					
					$sql_insert = "INSERT INTO tblUser (FirstName, LastName, email, Password, Address, City, State, Zip, Country)
						VALUES ('" . $firstname . "', 
								'" . $lastname . "',
								'" . $inputEmail4 . "',
								'" . $inputPassword4 . "',
								'" . $inputAddress . $inputAddress2 . "',
								'" . $inputCity . "',
								'" . $inputState . "',
								'" . $inputZip . "',
								'" . $country ."')";
								
					//insert into the database
					$result_insert = DB::query($sql_insert);
					
					if(is_null($result_insert)){
						$error = "Error to save !";
					}else{
						header("Location: login.php");
					}
				}else{
					$error = "This emails address is previouly registered !";
				}//end if ... else
				
			}else{
				$error = "The passwords you entered are different !";
				$inputPassword4 = $confirm = "";
				
			}	//end else
		}//end else
}//end if

echo $twig->render("registration.html",
			 array("error"=>$error,
				   "firstname" =>$firstname,
				   "lastname" =>$lastname,
				   "inputEmail4" =>$inputEmail4,
				   "inputAddress" =>$inputAddress,
				   "inputAddress2" =>$inputAddress2,
				   "inputCity" =>$inputCity,
				   "inputState" =>$inputState,
				   "inputZip" =>$inputZip,
				   "country" =>$country)
				);
				

 ?>
