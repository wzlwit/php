<?php
 // files that contains all my functions

require ('vendor/autoload.php');



function pr($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "<pre>";
}

function displayAlert($message, $class = "primary")
{
    echo "<div class='alert alert-" . $class . "'>" . $message . "</div>";
}

function fah2cel($far)
{
    return number_format((($far - 32) * 5 / 9), 2);
}

function cel2fah($cel)
{
    return number_format(($cel * 9 / 5 + 32), 2);
}

function get_rand_tem()
{
    return mt_rand(-4000, 4000) / 100; //return random floats
}

$db; //global database object
function database_connect()
{
    global $db;
    $db = new mysqli("localhost", "ipd", "ipdipd","ipd16");

    // check for connection errors
    if ($db->connect_errno > 0) {
        echo "connection failed: " . $db->connect_errno;
        die();
    }
    echo 'good connection <br>';
}

?>
<!--  --> 