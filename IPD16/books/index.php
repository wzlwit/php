<?php
include("includes/functions.php");

// *monolog configuration
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // start logger
    $log = new Logger('login_log');
    // set up logger file // keep the level as WARNING, higher leve (warning etc) will be shown also
    $log->pushHandler(new StreamHandler('login_log.log', Logger::DEBUG));

    $log->info("Login Attempt");


    if (isset($_POST['name']) && $_POST['name'] == "") {
        $error = "string has nothing<br>";
    } else if (isset($_POST['password']) && $_POST['password'] == "") {
        $error = "password has nothing<br>";
    } else {

        //* 1. connect to database
        database_connect();

        //* 2. prepare our sql
        $query = $db->prepare("SELECT id, name, type, password FROM users WHERE username=? LIMIT 1");

        $query->bind_param("s", $_POST['uname']); //("ss", $[uname],$[pwd]
        // $qresult=array('q_id'=>'','q_name'=>'','q_type'=>'','q_pw'=>'');
        // $query->bind_result($qresult);
        $query->bind_result($q_id, $q_name, $q_type, $q_pw);

        //* 3. execute sql statement
        $query->execute();
        $query->store_result(); //store information base on the pointer( next())
        //* $query->fetch(); //get the result

        // echo $qresult;

        if ($query->num_rows != 1) {
            echo "user does not exist";
        } else {
            $query->fetch(); //retrieve the rows
            if ($q_pw != md5($_POST['psw'])) {
                $error = "passwords do not match!";
            } else {
                $_SESSION['u_id'] = $q_id;
                $_SESSION['u_type'] = $q_type;
                $_SESSION['u_name'] = $q_name;

                // woohoo we are  logged in
                echo "logged in :)";

                //* 4. update our last_login if user found
                $query_update = $db->prepare("UPDATE users SET last_login =now() WHERE id=? LIMIT 1");
                $query_update->bind_param("i", $q_id);
                // execute
                $query_update->execute();
                if ($query_update->affected_rows != 1) {
                    //echo "didn't update time";
                } else {

                    // redirect user on successful login
                    header("location: Books.php");
                }
            }
        }
    }
}


echo $twig->render('login_form.html', array("form_action" => $_SERVER['PHP_SELF'], 'error' => $error));

?>
<!--  --> 