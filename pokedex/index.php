<?php
  require_once("pokemon_functions.php");
  require_once("igdb_functions.php");
 ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles/pokedex.css"/>
    <title>Pok&eacute;dex</title>
  </head>
  <body>
    <div id="mewtwo">

      <!-- Pokemon Logo -->
      <div class=" mx-auto " style="width: 200px;">
          <img class="mt-3" src="images/International_Pokémon_logo.png" alt="pokemon logo"/>
      </div>
      <!-- end Pokemon Logo -->

      <!-- Main Pokedex start -->
      <div id="mycontainer" class="container mt-5 rounded shadow-lg mb-5">
        <div class="row  ">
          <!-- will hold the list of pokemon -->
          <div class="col">
            <h4 class="text-center text-white">Pok&eacute;dex</h4>
            <h6 class="text-white">Who's that Pok&eacute;mon?</h6>
              <ul class="list font">
                <?php
                $list = [];
                $page = 1;
                $count = 0;
                  foreach(getPokemonList($base_url) as $listItem){
                  $list[] = ["page" =>$page, "pokemon" => $listItem->name];
                  $count++;
                    if($count == 10){
                    $count = 0;
                    $page++;
                    }
                  }
                  foreach($list as $myList){
                    if(isset($_GET['page']) && $_GET['page'] != ""){
                      if($myList['page'] == $_GET['page'])
                        echo "<li><a href='?page=".$_GET['page']."&pokemon=".$myList['pokemon']."' class='text-white'>".$myList['pokemon']."</a></li>";
                    }else{
                      if($myList['page'] == 1)
                        echo "<li><a href='?pokemon=".$myList['pokemon']."' class='text-white'>".$myList['pokemon']."</a></li>";
                    }
                  }
                ?>
              </ul>
          </div>
          <!-- will hold info of a selected pokemon -->
          <div class="col ">
            <div class="row">
              <div class="col col text-center">
                 <table class="container text-white">
                   <tr>
                     <th>Normal</th>
                     <th>Shiny</th>
                   </tr>
                   <tr>
                     <?php
                     if(isset($_GET['pokemon']) && $_GET['pokemon'] != ""){
                       $data = getSpecificPokemon($base_url, $_GET['pokemon']);
                       echo "<td><img src='".$data->sprites->front_default."' alt=''/></td>";
                       echo "<td><img src='".$data->sprites->front_shiny."' alt=''/></td>";
                     }else{
                       echo "<td><img src='images/pokeball.png' alt='pokeball'/></td>";
                       echo "<td><img src='images/pokeball.png' alt='pokeball'/></td>";
                     }
                      ?>
                   </tr>
                 </table>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <ul class="list ml-3 text-white">
                  <?php
                  if(isset($_GET['pokemon']) && $_GET['pokemon'] != ""){
                    $data = getSpecificPokemon($base_url, $_GET['pokemon']);
                    echo  "<li><span class='font'>ID:</span> ".$data->id."</li>";
                    echo  "<li><span class='font'>Name:</span> ".$data->name."</li>";
                    echo  "<li><span class='font'>Height:</span> ".$data->height."</li>";
                    echo  "<li><span class='font'>Weight:</span> ".$data->weight."</li>";
                  }else{
                    echo  "<li><span class='font'>ID: -----</span></li>";
                    echo  "<li><span class='font'>Name: -----</span></li>";
                    echo  "<li><span class='font'>Height: -----</span></li>";
                    echo  "<li><span class='font'>Weight: -----</span></li>";
                  }
                  ?>
                </ul>
              </div>
              <div class="col">
                <ul class="list text-white">
                  <?php
                  if(isset($_GET['pokemon']) && $_GET['pokemon'] != ""){
                    $data = getSpecificPokemon($base_url, $_GET['pokemon']);
                    foreach($data->types as $listData)
                      $type[] = $listData;
                    foreach($data->abilities as $listData)
                      $abilities[] = $listData;
                    echo "<li><span class='font'>Abilities:</span> ";
                    foreach($abilities as $abs)
                    echo $abs->ability->name. " ";
                    echo "</li>";
                    echo "<li><span class='font'>Types:</span> ";
                    foreach($type as $types)
                    echo $types->type->name. " ";
                    echo "</li>";
                  }else{
                    echo  "<li><span class='font'>Ability: -----</span></li>";
                    echo  "<li><span class='font'>Type: -----</span></li>";
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="<?php if(isset($_GET['page']) && $_GET['page'] != 1){
                  $pagination = $_GET['page'] - 1;
                  echo "?page=".$pagination;
                }?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <?php
                $pages = [];
                foreach($list as $myList){
                  if(!in_array($myList['page'], $pages))
                    $pages[] = $myList['page'];
                }
                  if(isset($_GET['page']) && $_GET['page'] != 1 && $_GET['page'] != ""){
                    if(isset($_GET['page']) && $_GET['page'] == 95){
                      echo "<li class='page-item'><a class='page-link' href='?page=94'>94</a></li>";
                      echo "<li class='page-item'><a class='page-link' href='?page=95'>95</a></li>";
                    }else{
                      $prev = $_GET['page'] - 1;
                      $next = $_GET['page'] + 1;
                      echo "<li class='page-item'><a class='page-link' href='?page=".$prev."'>".$prev."</a></li>";
                      echo "<li class='page-item'><a class='page-link' href='?page=".$_GET['page']."'>".$_GET['page']."</a></li>";
                      echo "<li class='page-item'><a class='page-link' href='?page=".$next."'>".$next."</a></li>";
                    }
                  }else{
                    echo "<li class='page-item'><a class='page-link' href='?page=1'>1</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page=2'>2</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page=3'>3</a></li>";
                  }
              ?>
              <li class="page-item">
                <a class="page-link" href="<?php
                if(!isset($_GET['page'])){
                  $pagination = 2;
                  echo "?page=".$pagination;
                }else if(isset($_GET['page']) && $_GET['page'] != 95){
                  $pagination = $_GET['page'] + 1;
                  echo "?page=".$pagination;
                }
                ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- End Main Pokedex -->

      <!-- Game List start -->
      <div class="container">
          <?php
          if(isset($_GET['pokemon']) && $_GET['pokemon'] != ""){
            $myData = getGameList($base_url, $_GET['pokemon']);
            if($myData == "Sorry, no data available."){
              echo "<h3>".$myData."</h3>";
            }else{
              echo "<h4 class='text-center mb-5'>A wild <strong><i>".$_GET['pokemon']."</i></strong> appears in the following games!</h4>";
              echo "<ul class='list-unstyled'>";
              foreach($myData as $gameData){
              $search[] = getPokemonGames($base_url_igdb, $gameData);
              }
              $gameID = [];
              foreach($search as $id){
                foreach($id as $obj){
                  if(!in_array($obj->id, $gameID))
                    $gameID[] = $obj->id;
                }
              }
              foreach($gameID as $id){
                $versionID = getGamesByID($base_url_igdb, $id);
                foreach($versionID as $summary){
                  if(isset($summary->summary) && $summary->summary != "" &&
                    isset($summary->cover->url) && $summary->cover->url != "" &&
                    isset($summary->name) && $summary->name != ""
                  ){
                    $store = $summary->summary;
                    $img = $summary->cover->url;
                    $name = $summary->name;
                    $date = $summary->release_dates[0]->human;
                    echo "<li class='media mt-2'>";
                    echo "<img class='mr-3' src='".$img."' alt='Generic placeholder image'>";
                    echo "<div class='media-body'>";
                    if(isset($summary->websites[0]->url) && $summary->websites[0]->url != ""){
                      $web = $summary->websites[0]->url;
                      echo "<a href='".$web."'><h5 class='mt-0 mb-1 text-dark'>".$name."</h5></a>";
                    }else{
                      echo "<h5 class='mt-0 mb-1'>".$name." (No available website)</h5>";
                    }
                    echo $store."<br/>";
                    echo "<span class='font'>Release Date: </span>".$date;
                    echo "</div>";
                  }
                }
              }
            }
            echo "</ul>";
          }
          ?>
      </div>
      <!-- Game List end -->
    </div>

  </body>
</html>
