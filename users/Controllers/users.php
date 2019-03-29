<?php  // Controllers/users.php
// ! everything realted (update, delete... ) should be in this file for controlling
class Users extends Controller
{
    protected $users;
    function __construct()
    {
        parent::__construct();
        $this->users = new User_Model($this->db); 
        //* create models for each table respectively
    }

    // * passed in args ($db, $args, )

    // * user listing
    function listing($f3)
    // *controller needs args passed in when defined
    {

        // $users = new User_Model($this->db);
        // $list = $users->fetch_all();

        $list = $this->users->fetch_all();
        echo date("Y-m-d H:i:s",time());
        echo $f3->get('twig')->render("members_list.html", array("members" => $list, "ALIAS" => $f3->get('ALIASES')));
    }

    function create($f3)
    {
        echo $f3->get('twig')->render("members_form.html", array("form_action" => "members/create"));
    }

    function create_post($f3)
    {
        $this->users->add();
        // $f3->reroute('/members');
    }

    function update($f3, $param) //*all the prarameters for get will be passed in as the second arg

    {
        print_r($param);
        echo "the user id is: " . $param['id'];
        // todo check if ($param['id']) is numeric
        // $id=$param['id'];
        // $info = $this->users->fetch_by_id($id);

        $info = $this->users->fetch_by_id($param['id']);

        // echo '<pre>';
        // print_r($info);
        // echo '</pre>';

        echo $f3->get('twig')->render("members_form.html", array("info" => $info, "form_action" => "members/update/" . $param['id'], "ALIAS" => $f3->get('ALIASES'))); //alias is required for this case
    }

    function update_post($f3, $param)
    {
        // function update_post($f3) {
        // validation to complete
        // print_r($_SESSION['id']);
        $this->users->edit($param['id']);
        // $this->users->edit();
        $f3->reroute('/members');
    }

    function delete($f3, $param)
    {
        $this->users->remove($param['id']);
        $f3->reroute('/members');
    }
}
?>
<!--  --> 