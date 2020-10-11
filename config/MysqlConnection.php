<?php
namespace config ;
use \PDO ;
use \PDOException;

class  MysqlConnection
{

   private   $conn = null;

    public function __construct()
    {


        $servername = "localhost";
        $username = "phpmyadmin";
        $password = "root";
        $dbname = "school";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
       return $this ;
    }

    public  function getDb()
    {
        return $this->conn;
    }
}


