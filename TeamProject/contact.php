 <?php
require_once "functions.php";

$submit = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["FirstName"]) && $_POST["FirstName"] != "" &&
     isset($_POST["LastName"]) && $_POST["LastName"] != "" &&
     isset($_POST["Email"]) && $_POST["Email"] != "" &&
     isset($_POST["Subject"]) && $_POST["Subject"] != "" &&
     isset($_POST["Message"]) && $_POST["Message"] != ""
   ){
     DB::insert('tblcontact', array(
                'firstName' => $_POST["FirstName"],
                'lastName' => $_POST["LastName"],
                'email' => $_POST["Email"],
                'subject' => $_POST["Subject"],
                'message' => $_POST["Message"]
              ));

                $submit = "succeed";
   }else{
     $submit = "failed";
   }
}

echo $twig->render("contact.html", array("submitted"=>$submit));

?>
