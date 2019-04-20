<?php
$people = array(
  2 => ["name" => "John", "city" => "Ottawa"],
  4 => ["name" => "Jane", "city" => "Montreal"],
  5 => ["name" => "Jenn", "city" => "Chicago"]
);

// Only accept the get method
if($_SERVER['REQUEST_METHOD'] == "GET"){
  $data = [];
  $user = [];
  $found = false;
  if(isset($_GET['id'])){
    foreach($people as $id => $person)
      if($_GET['id'] == $id){
        response(["Person" => $person, "Link" => "http://localhost:8080/rest/inedx.php?id=".$id]);
        $found = true;
      }
      if(!$found)  response(["error" => "Error, Person does not exists."], 404);
    }else{
      foreach($people as $id => $person)
      $user[] = ["Person" => $person, "Link" => "http://localhost:8080/rest/inedx.php?id=".$id];
      response($user);
    }
  }else{
      response(["error" => "We only want get method.", 405]);
  }

function responseJson($data){
  // change the content type to json
  header("Content-Type:application/json");
  // echo the array as json
  echo json_encode($data);
}

function responseXML($data){
  // Change the content type to XML
  header("Content-Type: text/xml");

  $xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
  array_to_xml($data, $xml);
  print $xml->asXML();

}

function response($data, $status = 200){
  $format = "json";
  if(isset($_GET['format'])){
    if($_GET['format'] == "xml"){
      $format = "xml";
    }elseif($_GET['format'] != "json"){
      $data = ["error" => "Unknown format request."];
      $status = 400;
    }
  }

  // setout header status
  header("HTTP/1.1 ". $status);

  if($format == "xml"){
    responseXML($data);
  }else{
    responseJson($data);
  }
}

// function defination to convert array to xml
function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_numeric($key) ){
            $key = 'item'.$key; //dealing with <0/>..<n/> issues
        }
        if( is_array($value) ) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}
?>
