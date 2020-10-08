<?php 
namespace controller ;
use config\MysqlConnection as db;
use controller\Engine as engine;

class Resource{

    public function __construct()
    {
        $this->db = new db();
        engine::load();
        

    }
}
