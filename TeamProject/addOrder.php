<?php
require_once "functions.php";



if($_SERVER['REQUEST_METHOD']=='POST')
{
    
    if(is_array($arr))
    {
     if(array_key_exists($_POST["proid"],$arr))
     {            
          $uu=$arr[$_POST["proid"]]; 
          $uu["count"]=$uu["count"]+$_POST['count'];  
          $uu["price"]=$uu["count"] * $uu['price'];
          $arr[$_POST["proid"]]=$uu; 
          

     }
     else
     {   
          $price = $_POST["count"] *$_POST["proPrice"];
          $arr[$_POST["proid"]]=array(
            "pid"=> $_POST["proid"],
            'pname'=>$_POST["proName"],
            'count'=>$_POST["count"],
            'price'=> $price
          );
     }
        
    }else
    {
        $price = $_POST["count"] *$_POST["proPrice"];
        $arr[$_POST["proid"]] = array(
            "pid"=> $_POST["proid"],
            'pname'=>$_POST["proName"],
            'count'=>$_POST["count"],
            'price'=>$price
        );
    }
    ob_clean();
    $_SESSION['cart'] = $arr;

    header("Location: productDetail.php?id=".$_POST['proid']);
}