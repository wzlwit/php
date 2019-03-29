<!DOCTYPE html>
<?php
require './functions/functions.php';
database_connect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $filled = false;
    // TODO: check all is entered
    foreach ($_POST as $key => $value) {
        // ! have to check if isset(), if not set, the element will not exist in the array
        if ($value == "") {
            $filled = false;
            echo "please enter all the fields!";
            break;
        } else {
            $filled = true;
        }
    }
    // echo "not breaked";

    // todo: check special requirement
    if ($filled) {
        if (!preg_match('/^[A-Z]/', $_POST['person_1']) || !preg_match('/^[A-Z]/', $_POST['person_2'])) {
            // check capitalized person
            echo "plese enter the person's name with a capital letter!<br>";
        } else if (!is_numeric($_POST['number'])) {
            // check numeric
            echo "the field for number requires a numeric value!<br>";
        } else if (!preg_match('/\S*s$/', $_POST['plural_noun'])) {
            // check Plural Noun
            echo "the field for Plural_Noun requires a 's' at the end!<br>";
        } else if (!in_array($_POST['holiday'], array(
            "Valentine's Day",
            "Mother's Day",
            "Canada Day",
            "Thanksgiving",
            "Halloween"
        ))) {
            echo "please choose a correct holiday<br>";
        } else {
            // * insert the value
            $insert = $db->prepare("INSERT INTO mad_lib (person_1, color, noun_1, food, plural_noun, holiday, noun_2, number, person_2, occupation,time_made) VALUES (?,?,?,?,?,?,?,?,?,?,now())"); // create sql statement



            $insert->bind_param("sssssssdss", $_POST['person_1'], $_POST['color'], $_POST['noun_1'], $_POST['food'], $_POST['plural_noun'], $_POST['holiday'], $_POST['noun_2'], $_POST['number'], $_POST['person_2'], $_POST['occupation']);
            // $insert->bind_result($id, $person_1, $color, $noun_1, $food, $plural_noun, $holiday, $noun_2, $number, $person_2, $occupation); // bind varaibles to fields
            $insert->execute();

            header("location: index.php"); //go to home page to show the latest record
        }
    }
}

// todo: check if there is record existed in the Mad Lib:
$query = $db->prepare("SELECT * FROM mad_lib order by time_made desc limit 1"); // create sql statement
$query->bind_result($id, $person_1, $color, $noun_1, $food, $plural_noun, $holiday, $noun_2, $number, $person_2, $occupation, $time_made); // bind varaibles to fields
$query->execute();
$query->store_result();
if ($query->num_rows != 1) { // number of rows returned
    echo "There is no record in mad lib yet, please create one first:<br>";
} /* else {
    $query->fetch(); //retrieve the rows
    pr($query);
} */
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mad Lib</title>
    <style>
    </style>
</head>

<body>
    <h1>Mad Lib:</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <h2>Enter all the information as follows:</h2>
        <label>
            Person 1:
            <input type="text" name="person_1">
            (enter a name starting with a capital letter)
        </label>
        <br><br>
        <label>
            Color:
            <input type="text" name="color">
            (enter a color)
        </label>
        <br><br>
        <label>
            Noun 1:
            <input type="text" name="noun_1">
            (enter a noun)
        </label>
        <br><br>
        <label>
            Food:
            <input type="text" name="food">
            (enter a food name)
        </label>
        <br><br>
        <label>
            Plural Noun:
            <input type="text" name="plural_noun">
            (enter a plural noun ending with s)
        </label>
        <br><br>
        <label>
            Holiday:
            <select name="holiday">
                <option value="Valentine's Day">Valentine's Day</option>
                <option value="Mother's Day">Mother's Day</option>
                <option value="Canada Day">Canada Day</option>
                <option value="Thanksgiving">Thanksgiving</option>
                <option value="Halloween">Halloween</option>
                <!-- <option value="test">only for test</option> -->
            </select>
            (select a Holiday you like)
        </label>
        <br><br>
        <label>
            noun_2:
            <input type="text" name="noun_2">
            (enter a second noun)
        </label>
        <br><br>
        <label>
            Number:
            <input type="number" name="number" min="0">
            (enter a number)
        </label>
        <br><br>
        <label>
            Person 2:
            <input type="text" name="person_2">
            (enter a second name starting with a capital letter)
        </label>
        <br><br>
        <label>
            Occupation:
            <input type="text" name="occupation">
            (enter an ocupation)
        </label>
        <br>
        <br>
        <input type="submit" name="create" value="Create">
        <br><br>
        <input type="button" name="home" value="Home" onClick="location.href = './index.php'">
        <input type="button" name="listing" value="Listing" onClick="location.href = './listing.php'">

    </form>

</body>

</html>

<!- - --> 