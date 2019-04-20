<?php
// Use web services of https://swapi.co/

// set base url of web service
$base_url = "https://swapi.co/api/";

// function to setup curl
function fetchCurl($url){
  // initialize curl and assign to a curl handler $ch
  $ch = curl_init($url);

  //prevent automatic output to the screen
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // curl_setopt() has 3 parameters

  /*
    in case of MAMP issues
    write these two lines
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  */

  // execute our request
  $data = curl_exec($ch);

  // close curl
  curl_close($ch);

  // return result in json
  return json_decode($data);
}

// Request vehicles, people, films, species or planets
$page = 1; // Result is in numbered pages, to access every result, increment the page
$counter = 1; // (Optional) Helps to number the results.
do{
  // The request page, films can be changed to vehicles, people, species or planets to access different information available on the service
  $url = $base_url."films/?page=".$page++;
  // Use the function to initialize curl on this webpage
  $data = fetchCurl($url);
  // Loop and echo every result
  foreach($data->results as $item){
    echo $counter++. "."; // This will number every result
    if(isset($item->name))
      echo $item->name."<br/>"; // Any request except films will use this line.
    else {
      echo $item->title."<br/>"; // films doesnt have an index name but has title, this will run when films is being requested.
    }
  }

}while(!(empty($data->next))); // If next(next page) is emppty, terminate the loop

?>
