<!DOCTYPE html>
<?php
include './includes/functions.php';

//TODO: only allow logged in users to view page

// connect to database
database_connect();

// get list of all users
$query = $db->prepare("SELECT id, name, last_login, type FROM users"); //create sql statement
$query->bind_result($u_id, $u_name, $u_last_login, $u_type);
$query->execute();
$query->store_result();
// show all users

// POST FORM SUBMITTED
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // FORM submitted

    // TODO: Validate form data
    // already connected to database
    $pw = md5($_POST['password']);
    $insert = $db->prepare("INSERT INTO users (name, username, password, type) VALUES(?,?,?,?)");
    $insert->bind_param("ssss", $_POST['n_name'], $_POST['u_name'], $pw, $_POST['type']);
    $insert->execute();

    header("Location: users.php"); //using header() to avoid resubmit
}

?>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <h2>Users List</h2>

    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Last Login</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
        <?php
        while ($query->fetch()) {
            ?>
        <tr>
            <td><?php echo $u_id ?></td>
            <td><?php echo $u_name ?></td>
            <td><?php echo $u_last_login == "" ? "" : date("l\, F d Y \a\\t h\:ia", strtotime($u_last_login)) ?></td>
            <td><?php echo $u_type ?></td>
            <td>
                <a href="user_edit.php?user_id=<?php echo $u_id; ?>">Edit</a>
                <a href="user_edit.php?user_id=<?php echo $u_id; ?>&delete=1">Delete</a>
            </td>

        </tr>
        <?php

    }
    ?>

        <!-- 
            <tr>
            <td>4</td>
            <td>Giovanni Rovelli</td>
            <td>Friday, March 02 2016 at 11:82am</td>
            </tr>
         -->
    </table>

    <hr>

    <h2>Create User</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Nice name:
        <input type="text" name="n_name" value="">
        <br>
        User name:
        <input type="text" name="u_name" value="">
        <br>
        Password:
        <input type="text" name="password" value="">
        <br>
        User Type:
        <select name="type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br><br>
        <input type="submit" value="Submit">
    </form>

</body>

</html> 