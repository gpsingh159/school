<?php 
namespace controller ;
use config\MysqlConnection as db;
use controller\Engine as engine;
use model\Common;

class Resource{

    public function __construct()
    {
        
        engine::load();
        

    }
}
