<?php  // Models/user_modes.php

// * the class name must be the same as file name (case-insensitive)
// ! one model for one table, cannot create a total model for a database

class User_Model extends DB\SQL\Mapper
{
    // * when instantiate a model, all the table names will be created as an property for the object

    /**
 * for this model ,there will be many var as:
 *  this->id
 *  this->user
 *  this->username
 *  this->last_login
 */


    function __construct(DB\SQL $db)
    //DB\SQL means the type is an SQL object

    // function __construct( $tbname)
    {
        parent::__construct($db, "users");
        // connect to table 'users'
    }

    function fetch_all()
    {
        $this->load();
        return $this->query;
    }

    function fetch_by_id($id)
    {
        $this->load(array("id=?", $id));
        return $this->query[0];
    }



    function edit($id)
    {
        $this->load(array("id=?", $id));

        //* we can use POST way to get the information
        // $this->load(array("id=?", $_POST['id'])); 

        $this->copyFrom("POST");

        // $this->password = md5($_POST['password']);
        $this->password = md5($this->password);
        $this->last_login = date("Y-m-d H:i:s", time());

        $this->update();
    }


    /*     
    function edit()
    {
        echo $_SESSION['id'];
        $this->load(array("id=?", $_SESSION['id']));
        $this->copyFrom("POST");

        $this->password = md5($_POST['password']);
        $this->password = md5($this->password);

        $this->update();
    } 
    */

    function add()
    {
        $this->copyFrom('POST');
        // todo encrypt password
        $this->password = md5($this->password);
        $this->save();
    }

    function remove($id)
    {
        $this->load(array("id=?", $id));
        $this->erase();
    }
}

?>
<!--  --> 