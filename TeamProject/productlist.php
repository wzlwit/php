<?php
require_once "functions.php";
//require_once("meekro/meekrodb.2.3.class.php");

//echo $twig->render("productList.html");


$pros=array();

$cart=array();

if($_SERVER['REQUEST_METHOD']=='GET')
{
  if(!isset($_GET['cate'])||$_GET['cate']=="")
  {
    $pros = DB::query("SELECT * from tblproduct WHERE Active = 1 ");
  }else
  {
    $pros = DB:: query("SELECT * from tblproduct WHERE ProCategory = %s and Active = 1",$_GET['cate']);
  }
 
  if(empty($pros))
    $noResult = 1;

  $cates = array("Laptop"=>"Laptop",
              "Games"=>"Games",
              "Books"=>"Books",
              "Music"=>"Music",
              "Movie"=>"Movie"            
          );

 if(isset($_SESSION['cart']))
          $cart = $_SESSION['cart'];

    //show the template page
  echo $twig->render("productList.html", array(
                                          "pros"=>$pros,
                                          "cates" =>$cates,                                          
                                          "buy_cart"=>$cart
                                      ));
}    


/*
$pros = DB::query("SELECT * from tblproduct");

$cart = array();
if(isset($_SESSION['cart']))
    $cart = $_SESSION['cart'];

  //show the template page
echo $twig->render("productList.html", array(
                                        "pros"=>$pros,
                                        "buy_cart"=>$cart
                                      ));
  */
?>