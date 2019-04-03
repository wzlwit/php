<?php
require('./includes/function.php');
$results=DB::query("SELECT DISTINCT location, count(*) as number FROM channel group by location ");
$countrys=array();

foreach( $results as $country)
{
$country["channels"]=DB::query("SELECT * FROM channel where location=%s",$country["location"]);
array_push($countrys,$country);
}

//pr($countrys);

echo $twig->render('./channel_info.html',
array('countrys'=>$countrys));

?>