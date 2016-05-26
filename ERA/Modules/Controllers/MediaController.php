<?php namespace ERA\Controllers;

class MediaController extends \Singleton {

    private $model;

    function __construct() {
        parent::__construct();
        $this->model = new MediaModel();
    }

}