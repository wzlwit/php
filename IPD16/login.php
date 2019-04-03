<?php
include("includes/functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['name']) && $_POST['name'] == "") {
        echo "string has nothing<br>";
    } else if (isset($_POST['password']) && $_POST['password'] == "") {
        echo "password has nothing<br>";
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
                echo "passwords do not match!";
            } else {
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
                    header("location: users.php");
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" target=_blank href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <h1 class="mt-5">LOGIN</h1>
        <p></p>
        <!--   <?php
                if ($message != '')
                    displayAlert($message, "danger");
                else if (isset($_SESSION['user']))
                    displayAlert('Welcome back ' . $_SESSION['user'] . '!')
                    ?> -->
        <form class="form-inline" action="" method="POST">
            <div class="form-group my-2 col-12">
                <label for="uname">USER NAME:</label>&nbsp;
                <input type="text" id="uname" name="uname" class="form-control" value="">
            </div>
            <div class="form-group my-sm-3 mb-2 col-12">
                <label for="password">PASSWORD:</label>&nbsp;
                <input type="password" id="psw" name="psw" class="form-control" value="">
            </div>
            <div class="form-group my-sm-3 mb-2 col-12">
                <input type="checkbox" value="remember" name="remember">&nbsp;
                <label for="remember"> Remember Me</label>
            </div>

            <button type="submit" clas s="btn btn-primary mb-2">Login</button>
        </form>

    </div>

</body>

</html> 