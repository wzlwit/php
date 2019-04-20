<?php
    require_once "functions.php";

    $products = array();
    
           // check session if admin login
        if($_SESSION['FirstName'] != 'admin')
        {   
            header('Location: productlist.php');
        }

        if(isset($_GET['cond'])||$_GET['cond']!="")
        {
            $products = DB::query("SELECT * FROM tblProduct WHERE ProCategory LIKE '%".$_GET['cond']."%'"."OR ProName LIKE "."'%".$_GET['cond']."%'");
        }else{
            $products = DB::query("SELECT * FROM tblProduct");
        }


    echo $twig->render("list_admin.html", array("products"=>$products));


