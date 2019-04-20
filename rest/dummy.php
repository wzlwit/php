<?php

$base_url = "http://dummy.restapiexample.com/api/v1/";

function post_curl($url, $parameters){

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  //setup post get_class_methods
  curl_setopt($ch, CURLOPT_POST, 1); // Request post
  curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters); // Post fields as string

  $data = curl_exec($ch);

  curl_close($ch);

  return json_decode($data);
}

function fetch_curl($url){

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $data = curl_exec($ch);

  curl_close($ch);

  return json_decode($data);
}

$data = post_curl($base_url."create", json_encode(array("name"=>"Goku", "salary"=>"123123", "age"=>"40")));
print_r(fetch_curl($base_url.'employee/'.$data->id));
 ?>
