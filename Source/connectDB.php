<?php
class Connect
{
    public $server;
    public $user;
    public $passwork;
    public $dbName;
    public function __construct()
    {
        // $this->server = "localhost";
        // $this->user = "root";
        // $this->passwork = "";
        // $this->dbName = "atn";
        $this->server = "ohunm00fjsjs1uzy.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	";
        $this->user = "gtnlyowc48ov4d36";
        $this->passwork = "tfdvk2obj0legbj6";
        $this->dbName = "ua5wa52vcbm5hlm2";
    }
    //Option 1: mysqli
    function connectToMySQL():mysqli
    {
        $conn_my = new mysqli($this->server, $this->user, $this->passwork, $this->dbName);
        if($conn_my->connect_error)
        {
            die("Failed". $conn_my->connect_error);
        }
        else
        {
        }
        return $conn_my;
    }
    //Option 2: PDO
    function connectToPDO():PDO
    {
        try
        {
            $conn_pdo = new PDO("mysql:host=$this->server;dbname=$this->dbName",$this->user, $this->passwork);

        }
        catch(PDOException $e)
        {
            print "Error: " . $e->getMessage();
        }
        return $conn_pdo;
    }
}

?>