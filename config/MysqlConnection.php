<?php
namespace config ;
use \PDO ;
class  MysqlConnection
{

   private   $conn = null;

    public function __construct()
    {


        $servername = "localhost";
        $username = "phpmyadmin";
        $password = "root";
        $dbname = "school";

        // Create connection
        $this->conn = new  PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
       // echo "Connected successfully";
    }

    public  function getDb()
    {
        return $this->conn;
    }
}


