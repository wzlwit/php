<?php  // Models/user_modes.php

// * the class name must be the same as file name (case-insensitive)
// ! one model for one table, cannot create a total model for a database

class User_Model extends DB\SQL\Mapper
{

    function __construct(DB\SQL $db)

    // function __construct( $tbname)
    {
        parent::__construct($db, "todo_users");
        // connect to table 'todo_users'
    }

    function fetch_all()
    {
       
        return $this->query[0];
    }

    function fetch_auth()
    {
        $this->load(array("username=?", $_POST['username']));
        return $this->query[0];
    }
}

?>
<!--  --> 