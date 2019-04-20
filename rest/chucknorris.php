<?php
$base = "https://api.chucknorris.io/jokes/";
echo "<h1>Random Chuck Norris Facts </h1>";

echo "Select category to view random facts about Chuck Norris.";

echo '<form action="" method="post">';
echo '<select name="select">';
      foreach(getCategories($base) as $value)
          echo "<option value=".$value.">".$value."</option>";
echo '</select>';
echo '<input type="submit"/>';
echo '</form>';

if($_SERVER['REQUEST_METHOD'] == "POST"){
  echo "<h2>".$_POST['select']."</h2>";
  echo '<img src="'.getJokesByCategory($base, $_POST['select'])->icon_url.'" alt=""/>';
  echo getJokesByCategory($base, $_POST['select'])->value;

}

function fetch_curl($url){

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $data = curl_exec($ch);

  curl_close($ch);

  return json_decode($data);
}

function getCategories($base){
  $url = $base."categories";

  $data = fetch_curl($url);

  return $data;
}

function getJokesByCategory($base, $category){
  $url = $base."random?category=".$category;

  $data = fetch_curl($url);

  return $data;
}

 ?>
