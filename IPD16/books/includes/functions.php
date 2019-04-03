<?php
require '../vendor/autoload.php';
// *monolog configuration
use Monolog\Logger;
use Monolog\ErrorHandler;

session_start();
// *meekro db configuration
DB::$user = 'ipd';
DB::$password = 'ipdipd';
DB::$dbName = 'ipd16';

// *twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


// require '../vendor/monolog/monolog/src/Monolog/Logger.php';
// require '../vendor/monolog/monolog/src/Monolog/ErrorHandler.php';

// // *monolog configuration
// use Monolog\Logger;
// use Monolog\ErrorHandler;

// // start logger

// $log = new Logger('login_log');
// // set up logger file // keep the level as WARNING, higher leve (warning etc) will be shown also
// $log->pushHandler(new StreamHandler('login_log.log', Logger::WARNING));

// $log->info("Login Attempt");






// *start session
@session_start();

function islogin()
{
    if (isset($_SESSION['u_id']) && $_SESSION['u_id'] != "" && is_numeric($_SESSION['u_id'])) {
        return true;
    } else return false;
}
function isadmin()
{
    if (isset($_SESSION['u_type']) && $_SESSION['u_type'] == 'admin') {
        return true;
    } else return false;
}

$db; //global database object
function database_connect()
{
    global $db;
    $db = new mysqli("localhost", "ipd", "ipdipd", "ipd16");

    // check for connection errors
    if ($db->connect_errno > 0) {
        echo "connection failed: " . $db->connect_errno;
        die();
    }
    // echo 'good connection <br>';
}

function pr($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "<pre>";
}


$twig->addGlobal("islogin", islogin());
$twig->addGlobal("isadmin", isadmin());
$twig->addGlobal("session", $_SESSION);

/* if (isset($_SESSION['u_name'])) {
    $twig->addGlobal("uname", $_SESSION['u_name']);
} */
//other wise, there will be error: undefined var

?>
<!--  -->     