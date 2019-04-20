<?php
    require_once "functions.php";

    // check session if admin login
    if($_SESSION['FirstName'] != 'admin')
    {
        header('Location: productlist.php');
    }
    
    if($_SERVER["REQUEST_METHOD"]== 'POST')
    {
        if(isset($_POST['hid_ProID']) && is_numeric($_POST['hid_ProID']))
        {

            DB::query("SELECT * FROM tblorder as o INNER JOIN tblitem as i ON o.ItemID = i.ItemID WHERE i.IsPayed = 1");
            $count = DB::count();

            if($count == 0)
            {
                $product = DB::queryFirstRow("SELECT * FROM tblProduct WHERE ProID = %i",$_POST['hid_ProID']);

                
                DB::delete("tblProduct","ProId=%i",$_POST['hid_ProID']);
                header("Location: list_admin.php?cond=");
               
            }
        }else{
            header("Location: list_admin.php?cond=");
        }
    }