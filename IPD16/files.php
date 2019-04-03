<!DOCTYPE html>
<?php
require './includes/functions.php';
$error = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // we are in post method
    pr($_POST);
    pr($_FILES);
    if (isset($_FILES['image'])) {
        // FILES variable exists
        if ($_FILES['image']['error'] == 0) {
            // echo "file was successfully uploaded";
            $extension = strtolower(@end(explode(".", $_FILES['image']['name'])));
            pr($extension);

            $allowed_ext = array("png", "gif", "jpg", "jpeg");
            if (in_array($extension, $allowed_ext)) {
                // file extensions is allowed

                // * upload your file
                if (move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    "./uploads/" . $_POST['name'] . "." . $extension
                )) {
                    // file was uploaded
                    echo "hooray";
                    die(); //stop the script
                } else {
                    $error = "An error has occured";
                };
            } else {
                //  file extension is not allowed
                $error = "files must be an image";
            }
        } else {
            //there was an error
            switch ($_FILES['image']['error']) {
                case 1:
                case 2:
                    $error = "File size is too big";
                    break;
                case 3:
                case 4:
                    $error = "No file uploaded";
                    break;
                case 6:
                case 7:
                    $error = "Permission error";
                    break;
                default:
                    $error = "Blame PHP!!!";
            }
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Files</title>
</head>

<body>
    <?php if ($error != "") echo "<strong>$error</strong>"; ?>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        Name your file:
        <input type="text" name="name">
        <br>
        File Upload:
        <input type="file" name="image">
        <br>
        <input type="file" name="txt">
        <br>

        <input type="submit" name="btn_img" value="UPLOAD">
        <input type="submit" name="btn_img2" value="UPLOAD">
        <!-- only clicked button's value will be submitted -->
    </form>
</body>

</html> 