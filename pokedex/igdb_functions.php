<?php

$base_url_igdb = "https://api-endpoint.igdb.com/";

function igdb_curl($url){

  $ch = curl_init($url);

  $key = array("user-key: d736ad775e820ed7ad8e1a87594c1d24",
              "Accept: application/json"
  );

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER,$key);

  $data = curl_exec($ch);

  curl_close($ch);

  return json_decode($data);
}

function getPokemonGames($igdb, $game_name){
$specific = $game_name;
$url = $igdb."/games/?search=pokemon".$specific;

$data = igdb_curl($url);

return $data;

}


function getGamesByID($base_url_igdb, $id){

$url = $base_url_igdb."/games"."/".$id;

$data = igdb_curl($url);

return $data;

}

 ?>
