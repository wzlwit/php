<?php
$base_url = "https://pokeapi.co/api/v2/";

function fetch_curl($url){

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $data = curl_exec($ch);

  curl_close($ch);

  return json_decode($data);
}

function getPokemonList($base_url){
  $url = $base_url."pokemon/";

  $data = fetch_curl($url);
  $pokemonList = [];
  foreach($data->results as $list){
    $pokemonList[] = $list;
  }
  return $pokemonList;
}

function getSpecificPokemon($base_url, $post){
    $url = $base_url."pokemon/".$post."/";

    $data = fetch_curl($url);

    return $data;
}

function getGameList($base_url, $post){
  $pokemonGames = getSpecificPokemon($base_url, $post);
  $varGames = $pokemonGames->game_indices;
  $gameName = [];
  foreach($varGames as $myListingOfGames){
    $gameName[] = $myListingOfGames->version->name;
  }
    if(!empty($gameName))
      return $gameName;
    else
      return "Sorry, no data available.";
}
 ?>
