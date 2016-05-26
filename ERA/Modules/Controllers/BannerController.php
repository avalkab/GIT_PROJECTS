<?php namespace ERA\Controllers;

class BannerController extends \BaseController{
    private $model;

    function __construct() {
        //parent::__construct();
    }

    public function getBanners(Array $parameters = null) {
        return db()->get_results("
            SELECT ".$parameters['cols']."
            FROM view_banner
            ".$parameters['where']."
            ORDER by id DESC
            LIMIT ".$parameters['limit']."
        ");
    }
}