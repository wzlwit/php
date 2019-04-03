<?php
include_once './includes/function.php';

// if login as admin
$channel_update = array();
$activity = 'none';
$location = '';
$fields = array('name', 'source', 'location', 'icon', 'catecory');
$error = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // validation

    foreach ($fields as $f) {
        //check all fields are set and not empty strings
        if (!isset($_POST[$f]) || $_POST[$f] == "") {
            $message = "All fields are required<br>";
            break;
        }

    }
    // todo : updata validation

// upload icon file

 
    $location= $_POST['location'];

//update without change icon image

  if($_FILES["icon"]["error"]==4 && $_POST['img']=='img')
{

    DB::insert('channel', array(
        'name' => $_POST['name'],
        'source' => $_POST['source'],
        'location' => $_POST['location'],
        'category' => $_POST['Category']
   )
  );

}
    else{

    if ((($_FILES["icon"]["type"] == "image/gif")
        || ($_FILES["icon"]["type"] == "image/jpeg")
        || ($_FILES["icon"]["type"] == "image/png"))

      //  && ($_FILES["icon"]["size"] < 50000)
        
        ) {
        if ($_FILES["icon"]["error"] > 0) {
            $error = "Return Code: " . $_FILES["icon"]["error"] . "<br />";
        } else {

            if (file_exists("images/" . $_FILES["icon"]["name"])) {
                $error = $_FILES["icon"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["icon"]["tmp_name"],
                    "images/" . $_FILES["icon"]["name"]);
                $message = "Stored in: " . "images/" . $_FILES["icon"]["name"];
            }
        }
    } else {
        echo "Invalid file";
    }

    if ($error== "") { // still no errors... save to db
 echo $message;

 
      
//           echo 'name:'.$_POST['name'].br();
//           echo 'url:'.$_POST['url'].br();
//         echo 'location'.$_POST['location'].br();
// echo 'icon'.$_FILES["icon"]["name"].br();
// echo 'catecory'.$_POST['Category'].br();
   

        DB::insert('channel', array(
            'name' => $_POST['name'],
            'source' => $_POST['source'],
            'location' => $_POST['location'],
            'icon' => $_FILES["icon"]["name"],
            'category' => $_POST['Category']
       )
      );
       

        // header ("Location: admin.php?loacation= $location");
    }

}
}
// if click on update or delete
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['id']) &&is_numeric($_GET['id'] ))
   {
        $id = $_GET['id'];
        $activity = 'edit';
    //  if (isset($_GET['location']) &&$_GET['location']!='' )
    
// if click on delete
   if (isset($_GET['del']) && $_GET['del'] == 1) 
      {  
          // delete channel with ch_id
          DB::delete('channel', "ch_id=%i", $id);
          $location=$_GET['location'];
      }
      //update
      else {
// get information on the channels with the id= id get
          $channel_update = DB::queryFirstRow("SELECT * FROM channel WHERE ch_id=%i", $id);
      }
  }
}


$results = DB::query("SELECT DISTINCT location, count(*) as number FROM channel group by location ");
$countrys = array();

foreach ($results as $country) {
    $country["channels"] = DB::query("SELECT * FROM channel where location=%s", $country["location"]);
    array_push($countrys, $country);
}


// pr($countrys);
// pr($channel_update);
// pr($activity);
 //echo $location;

echo $twig->render('./admin.html',
    array('form_action' => $_SERVER['PHP_SELF'],
        'countrys' => $countrys,
        'channel_update' => $channel_update,
        'activity' => $activity,
        'location' => $location,
    ));
