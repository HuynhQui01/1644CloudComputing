<?php
class Connect
{
    public $server;
    public $user;
    public $passwork;
    public $dbName;
    public function __construct()
    {
        $this->server = "co28d739i4m2sb7j.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $this->user = "gz8u0ixf75k4lhqh";
        $this->passwork = "tstma1y12aqp1qze";
        $this->dbName = "trgf0210jvs71k4p";
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