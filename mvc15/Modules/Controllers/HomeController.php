<?php namespace ERA\Controllers;

class HomeController extends \BaseController{
    private $model;

    function __construct() {
        parent::__construct();
        $this->model = new \ERA\Models\HomeModel;
    }

    public function index() {
        //return $this->app->view->make('wellcome');
        $this->app->view->tpl('master');
        $this->app->view->setVars([
            'page_title' => 'Anasayfa',
            'page_name' => 'Merhaba',
            'page_sub_name' => 'ERA!'
        ]);
        return $this->app->view->run();
    }
}