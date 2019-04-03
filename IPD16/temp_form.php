<?php
require './includes/functions.php';
//function that will display the alert when it is called

function displayAlert($message, $class = "primary")
{
    echo "<div class='alert alert-" . $class . "'>" . $message . "</div>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cel = !empty($_POST['temp_cel']) && is_numeric($_POST['temp_cel']);
    $fah = !empty($_POST['temp_fah']) && is_numeric($_POST['temp_fah']);
    if ($cel && $fah) {
        displayAlert('We need only one numeric value', 'danger');
    } elseif ($cel) {
        $celvalue = $_POST['temp_cel'];
        $fahvalue = cel2fah($celvalue);
    } elseif ($fah) {
        $fahvalue = $_POST['temp_fah'];
        $celvalue = fah2cel($fahvalue);
    } else {
        displayAlert('Please enter a numeric value', 'danger');
    }
} else {
    displayAlert("the method to post is changed, don't try to hack it", 'danger');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="">

    <title>Temperature Conversion</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Temperature Conversion</h1>
        <p>Enter either a Celsius or Fahrenheit temperature to convert</p>

        <form class="form-inline" action="" method="POST">
            <div class="form-group m-2 col-12">
                <label for="num_cel">Celsius</label>
                <input type="number" id="num_cel" name="temp_cel" class="form-control" value="<?= $celvalue ?>">
            </div>
            <div class="form-group mx-sm-3 mb-2  col-12">
                <label for="num_fah">Fahrenheit</label>
                <input type="number" id="num_fah" name="temp_fah" class="form-control" value="<?= $fahvalue ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Convert</button>
        </form>
</body>

</html>
<!--  --> 