<?php

include_once '../config/config.php';

//create class in php OOP
class Database
{
    //properties for class
    public $host = HOST;
    public $user = USER;
    public $password = PASSWORD;
    public $database = DATABASE;
    public $link;
    public $error;

    // constructor function
    public function __construct()
    {
        $this->dbConnect();
    }

    //methods for class
    public function dbConnect()
    {
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->link) {
            $this->error = 'Databse Connection Failed';
            return false;
        }
    }

    //select query from database
    public function select($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error.__LINE__); // __LINE__ is called magic constants 
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // insert query 
    public function insert($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error. __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // update query 
    public function update($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error. __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // delete query 
    public function delete($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error. __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}

?>