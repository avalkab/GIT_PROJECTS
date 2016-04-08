<?php namespace ERA\Core;

class Auth extends \BaseModel {

    function __construct($type, $table, Array $fillable = null) {
        if (!empty($type) && !empty($table) && sizeof($fillable)>1) {
            $this->setRequestMethod($type);
            $this->setTable($table);
            $this->setFillable($fillable);
            parent::__construct();
        }
    }

}