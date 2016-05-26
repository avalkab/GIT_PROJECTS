<?php namespace ERA\Core;

include_once __ERA."Cores/DB/shared/ez_sql_core.php";
include_once __ERA."Cores/DB/pdo/ez_sql_pdo.php";

class DB extends \Singleton {
    public $db;
    function __construct() {
        $parameters = require_once(__ERA.'Configs/Database.php');
        $this->db = new \ezSQL_pdo(
            'mysql:host='.$parameters['host'].';dbname='.$parameters['dbname'].'',
            $parameters['username'],
            $parameters['password']
        );
        $this->db->query("SET NAMES 'utf8'");
    }
}