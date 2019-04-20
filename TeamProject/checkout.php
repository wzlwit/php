<?php
require_once 'functions.php';
$cart=array();
$total=0;
    if($_SERVER['REQUEST_METHOD']=='GET')
    {
        if(isset($_GET['userid'])|| is_numeric($_GET['userid']))
        {
            $user = DB::queryFirstRow("SELECT * FROM tbluser WHERE userID = %i",$_GET['userid']);

            if(isset($_SESSION['cart']))            
                $cart = $_SESSION['cart'];
            
            if(!empty($cart))
            {
                foreach ($cart as $item ) {
                    $total = $total + $item['price'];
                }
            }
            

            echo $twig->render("checkout.html",array("user"=>$user,"buy_cart"=>$cart,"total"=>$total));
        }
    }        


?>
