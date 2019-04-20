
<?php 

require_once "functions.php";

$UserName = $error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['email'])) $UserName = $_POST['email'];
	if (!isset($_POST['email']) || $_POST['email']=="") {
		$error = "Input Username";
	}elseif($_POST['email']=='admin@admin')// admin login
	{
		$_SESSION["logged_in"] = true;
		$_SESSION["FirstName"] = 'admin';
		header('Location: list_admin.php?cond');
	}
	elseif (!isset($_POST['password']) || ($_POST['password']=="")){
		$error = "Input Password";
	}else{		
		//check both email and password together
		$result = DB::queryFirstRow("Select * from tblUser WHERE email=%s AND Password=%s", $_POST['email'], md5($_POST['password']) );
		
		if(is_null($result)){
			$error = "Login was insuccessful";
		}else{
			//set session variables
			$_SESSION["logged_in"] = true;
			$_SESSION["username"] =  $result["username"];
			$_SESSION["FirstName"] = $result["FirstName"];
			$_SESSION['UserId'] =$result["UserID"];
			header("Location: index.php");
			
		}
	}
		  
}



echo $twig->render("login.html",
					array("error" => $error,
						"email" => $UserName)
					);

 ?>