<?php
error_reporting(0);
// Include nusoap library
require_once("lib/nusoap.php");

function stockPrice($name){

  $os = array("IBM" => "12.00", "APPLE" => "4.05", "MSN" => "6.02", "GOOGLE" => "12.21" );
  $price = -1;
 if(array_key_exists($name, $os))
    $price = $os[$name];

  return $price;

}

// Create new server instance
$server =  new soap_server();
$server->configureWSDL('server');

$server->register("stockPrice", // Method name
                    array("name" => "xsd:string"), // This array is the values for the request
                    array("price" => "xsd:decimal")
                  );

$server->service(file_get_contents("php://input"));
