<?php namespace ERA\Core;

include_once __ROOT."Cores/DB/shared/ez_sql_core.php";
include_once __ROOT."Cores/DB/pdo/ez_sql_pdo.php";

class DB extends \Singleton {
    public $db;
    function __construct() {
        echo 1;
        $parameters = require_once(__ROOT.'Configs/Database.php');
        $this->db = new \ezSQL_pdo(
            'mysql:host='.$parameters['host'].';dbname='.$parameters['dbname'].'',
            $parameters['username'],
            $parameters['password']
        );
    }
}