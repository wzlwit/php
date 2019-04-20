 <?php 
require_once "functions.php";

$pros = array();
$cart = array();

if($_SERVER['REQUEST_METHOD']=='GET')
{   
    if(isset($_GET['id'])||$_GET['id']!="")
    {
        $pros = DB::queryFirstRow("SELECT * FROM tblproduct WHERE ProId = %i", $_GET['id']);
    }
}

if(isset($_SESSION['cart']))
    $cart = $_SESSION['cart'];

echo $twig->render("productDetail.html", array("pros"=>$pros,"buy_cart"=>$cart));

?>