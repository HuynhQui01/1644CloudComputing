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
        $this->server = "ik1eybdutgxsm0lo.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $this->user = "ril8u3l3an7ox0ec";
        $this->passwork = "ca8ohqjyxx1qwcsm";
        $this->dbName = "e37k1cx7anyk74l8";
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