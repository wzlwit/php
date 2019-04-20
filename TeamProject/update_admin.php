<?php
    require_once "functions.php";    

    $active="";
    $img_path= "";
    if($_SERVER['REQUEST_METHOD']=='POST')
    {        
    
        if($_SESSION['product']['ProName']!=$_POST['ProName'])
            $_SESSION['product']['ProName'] = $_POST['ProName'];
        
        if($_SESSION['product']['ProDesc']!=$_POST['ProDesc'])
            $_SESSION['product']['ProDesc'] = $_POST['ProDesc'];
        
        if($_SESSION['product']['ProPrice']!=$_POST['ProPrice'])
            $_SESSION['product']['ProPrice'] = $_POST['ProPrice'];
        
        if($_SESSION['product']['InvQty']!=$_POST['InvQty'])
            $_SESSION['product']['InvQty'] = $_POST['InvQty'];
        
        if($_SESSION['product']['ProCategory']!=$_POST['ProCategory'])
            $_SESSION['product']['ProCategory'] = $_POST['ProCategory'];        


        if($_FILES['ProImg']['name'] != "")
        {
            unlink($_SESSION['product']['ProImg']);

            $OldName = $_FILES['ProImg']['name'];
            $tmp = explode('.',$OldName);
            $NewName = $_POST['ProName'].'.'.$tmp[1];            
            $newPath = "images/".$NewName;
            move_uploaded_file($_FILES['ProImg']['tmp_name'],$newPath);
            $_SESSION['product']['ProImg'] = $newPath;
        }

        if(isset($_POST['Active'])&&$_SESSION['product']['Active'] != $_POST['Active'])
        {
            $_SESSION['product']['Active'] = $_POST['Active']; 
        }else{
            $_SESSION['product']['Active'] = 0;
        }

        
        DB::update("tblproduct",array(
            "ProName"=>$_SESSION['product']['ProName'],
            "ProDesc"=>$_SESSION['product']['ProDesc'],
            "ProImg"=>$_SESSION['product']['ProImg'],
            "ProPrice"=>$_SESSION['product']['ProPrice'],
            "InvQty"=>$_SESSION['product']['InvQty'],
            "Active"=>$_SESSION['product']['Active'],
            "ProCategory"=>$_SESSION['product']['ProCategory']
        ),"ProID=%i",$_SESSION['product']['ProID']);        
       
        header("Location: list_admin.php?cond=".$_SESSION['product']['ProName']); 
    
    }
    if($_SERVER['REQUEST_METHOD']=='GET')
    {
        if(isset($_GET["hid_ProID"]) && $_GET["hid_ProID"]!="");
        {            
            getAllInfo($twig,$_GET["hid_ProID"]);
            print_r($_SESSION['product']);          
        }    
    }

    function getAllInfo($tg, $id){
        $cates = array("-select-"=>"1",
            "Laptop"=>"Laptop",
            "Games"=>"Games",
            "Books"=>"Books",
            "Music"=>"Music",
            "Movie"=>"Movie"            
        );

        $product = DB::queryFirstRow("SELECT * FROM tblProduct WHERE ProID = %i",$id);

        $_SESSION['product'] = $product;

        echo $tg->render("update_admin.html",array("product"=>$product,"cates"=>$cates));
    } 
    

    
    
