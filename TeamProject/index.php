<?php
require_once "functions.php";
 


$cates = array("Laptop"=>"Laptop",
              "Toy&Game"=>"Toy&Game",
              "Books"=>"Books",
              "Music"=>"Music",
              "Movie"=>"Movie"            
          );

$list = array();

foreach($cates as $cate){
    $result = DB::query("SELECT * FROM tblproduct Where ProCategory = %s",$cate);
    foreach($result as $res)
    {
        $list = array("cate"=>$cate, "pros"=>array("id"=>$res["ProID"],"data"=>$res));
    }
}

//print_r($list);
$cart = array();
if(isset($_SESSION['cart']))
    $cart = $_SESSION['cart'];


echo $twig->render("index.html", array("cates"=>$cates,"list"=>$list,"buy_cart"=>$cart));

?>
