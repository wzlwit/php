<?php

$base_url = "https://api.funtranslations.com/translate/";

function post_curl($url, $parameters){

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  //setup post get_class_methods
  curl_setopt($ch, CURLOPT_POST, 1); // Request post
  curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters); // Pst fields as string

  $data = curl_exec($ch);

  curl_close($ch);

  return json_decode($data);
}

print_r(post_curl($base_url."yoda", "text=This class is so much!"));
 ?>
