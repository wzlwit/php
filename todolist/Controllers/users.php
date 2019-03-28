<?php  // Controllers/users.php
// ! everything realted (update, delete... ) should be in this file for controlling
class Users extends Controller
{
    protected $users;
    function __construct()
    {
        parent::__construct();
        $this->users = new User_Model($this->db);
    }

    // * login form
    function login($f3)
    {
        echo $f3->get('twig')->render("login.html", array("form_action" => "login", "message" => "Enter your information"));
    }

    function login_post($f3)
    {

        $info = $this->users->fetch_auth(); //compare username to database

        if ($info['username'] == $_POST["username"] && ($info['password'] == md5($_POST['password']))) {
            $_SESSION['u_id'] = $info['id'];
            // echo $_SESSION['u_id'];
            $f3->reroute('/');
        } else {
            session_unset();
            echo $f3->get('twig')->render("login.html", array("form_action" => "login", "message" => "Wrong User Name or Password"));
        }
    }


    function logout($f3)
    {
        session_unset();
        $f3->reroute("/");
    }
}
?>
<!--  --> 