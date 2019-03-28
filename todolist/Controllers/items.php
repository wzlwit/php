<?php  // Controllers/items.php
// ! everything realted (update, delete... ) should be in this file for controlling
class Items extends Controller
{
    protected $items;
    function __construct()
    {
        parent::__construct();
        $this->items = new Item_Model($this->db);
    }


    // * user listing
    function listing($f3)
    // *controller needs args passed in when defined
    {
        // echo date("Y-m-d H:i:s", time());
        $list = $this->items->fetch_all();
        echo $f3->get('twig')->render("list.html", array("tasks" => $list, "islogin" => $f3->get('islogin')));
    }

    // * add a task
    function create($f3)
    {
        echo $f3->get('twig')->render("form.html", array("form_action" => "add", "message" => "Add a New Task to Your List of Things That You Need to Not Forget"));
    }

    function create_post($f3)
    {
        if (isset($_POST['name']) && $_POST['name'] != '') {
            $this->items->add();
            $f3->reroute('/');
        } else {
            echo $f3->get('twig')->render("form.html", array("form_action" => "add", "message" => "Task Name is required"));
        }
    }

    // *complete a task
    function complete($f3)
    {
        $this->items->complete();
        $f3->reroute('/');
    }

    // * delete a task
    function delete($f3)
    {
        $this->items->remove();
        $f3->reroute('/');
    }
}
?>
<!--  --> 