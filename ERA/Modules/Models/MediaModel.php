<?php namespace ERA\Models;

class MediaModel {

    protected $db;

    function __construct() {
        $this->db = db();
    }

}