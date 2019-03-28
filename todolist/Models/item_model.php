<?php  // Models/user_modes.php

// * the class name must be the same as file name (case-insensitive)
// ! one model for one table, cannot create a total model for a database

class Item_Model extends DB\SQL\Mapper
{

    function __construct(DB\SQL $db)
    //DB\SQL means the type is an SQL object

    // function __construct( $tbname)
    {
        parent::__construct($db, "todo_items");
        // connect to table 'todo_items'
    }

    function fetch_all()
    {
        $this->load();
        return $this->query;
    }

    function add()
    {
        $this->copyFrom('POST');
        $this->date_added = date("Y-m-d H:i:s", time());

        // * save ip address
        $this->ip_address=$_SERVER['REMOTE_ADDR'];
        $this->save();
    }

    function complete()
    {
        echo $_POST['i_id'];
        $this->load(array("id=?", $_POST['i_id']));
        // $this->copyFrom("POST");
        $this->completed = 1;
        $this->update();
    }

    function remove()
    {
        $this->load(array("id=?", $_POST['i_id']));
        $this->erase();
    }
}

?>
<!--  --> 