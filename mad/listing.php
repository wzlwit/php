<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mad Lib</title>
</head>

<body>
    <h2>Mad Lib lists:</h2>
    <?php
    require './functions/functions.php';
    database_connect();

    $query = $db->prepare("SELECT * FROM mad_lib order by time_made desc"); // create sql statement
    $query->bind_result($id, $person_1, $color, $noun_1, $food, $plural_noun, $holiday, $noun_2, $number, $person_2, $occupation, $time_made); // bind varaibles to fields
    $query->execute();
    $query->store_result();
    if ($query->num_rows < 1) { // number of rows returned
        // echo "There is no mad lib yet, please create one first";

        header("location: create.php"); //!if there no mad lib existed, just go to create page
    } else {


        // todo: show the message:


        while ($query->fetch()) {; //retrieve the rows
            ?>
    Dear <?php echo $person_1 ?>, <br>
    Thanks for ordering via the <?php echo $color . " " . $noun_1 ?> Candy Company website. Unfortunately, your <?php echo $food ?> flavored snacks are not available because <?php echo $plural_noun ?> accidentally fell into our mixer. We appologize for the inconvenience. Since you were ordering these for a party to celebrate <?php echo $holiday ?>, we are offering you <?php echo $noun_2 ?>-shapped truffles at a discount of <?php echo $number ?> dollars instead. <br><br>


    Sincerely, <br>
    <?php echo $person_2 ?>, <?php echo $occupation ?>
    <br><br><br>
    <?php

}
}
?>

    <br>

    <input type="button" name="home" value="home" onClick="location.href = './index.php'">
    <input type="button" name="create" value="Create" onClick="location.href = './create.php'">

</body>

</html>

<!--  --> 