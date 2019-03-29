<?php

function pr($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

//* create a function to connect database
// $db;
function database_connect()
{
    global $db;
    //CONNECT TO DB		server, user, 	password, database
    $db = new mysqli("localhost", "ipd", "ipdipd", "ipd16");

    //check for connection errors
    if ($db->connect_errno > 0) {
        echo "Connection failed: " . $db->connect_error;
        die();
    }
    // echo "Good connection";
}

?>
<!--  --> 