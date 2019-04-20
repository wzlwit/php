<?php 
require_once "functions.php";

$errors = array();
$img_path ="";
$product = "";

// check session if admin login
if($_SESSION['FirstName'] != 'admin')
{
    header('Location: productlist.php');
}


//add product into DB
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(!isset($_POST['ProName'])||trim($_POST['ProName']==""))
    {
        $errors['ProName'] = "Please provide product name";
    }

    if(!isset($_POST['ProPrice'])||$_POST['ProPrice']=="")
    {
        $errors['ProPrice'] = "Please provide product price.";
    }
    
    if(!isset($_POST['ProDesc'])||trim($_POST['ProDesc']==""))
    {
        $errors['ProDesc'] = "Please provide description of product.";
    }

    if(!isset($_POST['ProCategory'])||$_POST['ProCategory']=="1")
    {
        $errors['ProCategory'] = "Please select category.";
    }

    if(isset($_POST['Active']))
        $active = 1;
    else
        $active = 0;
    
    $OldName = $_FILES['ProImg']['name'];
    $tmp = explode('.',$OldName);
    $NewName = $_POST['ProName'].'.'.$tmp[1];
    $img_path = "images/".$NewName;
    move_uploaded_file($_FILES['ProImg']['tmp_name'],$img_path);
        
    

    if(empty($errors))
    {        
        DB::insert("tblproduct",array(
            "ProName"=>$_POST['ProName'],
            "ProDesc"=>$_POST['ProDesc'],
            "ProImg"=>$img_path,
            "ProPrice"=>$_POST['ProPrice'],
            "InvQty"=>$_POST['InvQty'],
            "Active"=>$active,
            "ProCategory"=>$_POST['ProCategory']
        ));        

        header("Location: list_admin.php?cond=".$_POST['ProName']);
    }
    
}


echo $twig->render("add_admin.html",array("errors"=>$errors,"product"=>$product));

?>