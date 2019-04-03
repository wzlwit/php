<!DOCTYPE html>
<?php
require './vendor/autoload.php';
include './includes/functions.php';
DB::$user = 'ipd';
DB::$password = 'ipdipd';
DB::$dbName = 'ipd16';
if (isset($_GET['user_id'])) {
    // check if user_id variable is in URL

    pr($_GET);
    if (isset($_GET['delete'])) {
        // delete the user
        DB::delete('users', 'id=%i', $_GET['user_id']);
        header("Location: users.php");
    }


    $info = DB::queryFirstRow("SELECT * FROM users WHERE id=%i", $_GET['user_id']);
    pr($info);
    if ($info == null) {
        die("No record found");
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "post method";
    pr($_POST);

    // * do all the validation required
    $fields_update = array(
        'name' => $_POST['n_name'],
        'username' => $_POST['u_name'],
        'type' => $_POST['type']
    );
    if ($_POST['password'] != "") {
        $fields_update['password'] = md5($_POST['password']);
    }
    DB::update("users", $fields_update, "id=%i", $_POST['u_id']);
    header("location: users.php");
} else {
    die("No user is set");
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
</head>

<body>
    <h2>Edit User</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Nice name:
        <input type="text" name="n_name" value="<?php echo $info['name'] ?>">
        <br>
        User name:
        <input type="text" name="u_name" value="<?php echo $info['username'] ?>">
        <br>
        Password:
        <input type="text" name="password" value="">
        <br>
        User Type:
        <select name="type">
            <option value="user" <?php echo $info['type'] == "User" ? "selected" : "" ?>>User</option>
            <option value="admin" <?php echo $info['type'] == "Admin" ? "selected" : "" ?>>Admin</option>
        </select>
        <br><br>
        <input type="submit" value="Submit">
        <input type="hidden" name="u_id" value=<?php echo $info['id'] ?>>

    </form>

</body>

</html> 