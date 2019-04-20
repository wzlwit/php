<?php 
require_once "functions.php";

$errors = array();
$img_path ="";

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

    //save img
    $OldName = $_FILES['ProImg']['name'];
    $tmp = explode('.',$OldName);
    $NewName = $_POST['ProName'].'.'.$tmp[1];
    $img_path = "images/".$NewName;
    move_uploaded_file($_FILES['ProImg']['tmp_name'],$img_path);
        
    

    if(empty($errors))
    {
        print_r($_FILES['ProImg']['tmp_name']);
        DB::insert("tblproduct",array(
            "ProName"=>$_POST['ProName'],
            "ProDesc"=>$_POST['ProDesc'],
            "ProImg"=>$img_path,
            "ProPrice"=>$_POST['ProPrice'],
            "InvQty"=>$_POST['InvQty'],
            "Active"=>$active,
            "ProCategory"=>$_POST['ProCategory']
        ));        
    }
    
}


echo $twig->render("addProduct.html",array("errors"=>$errors));

?>