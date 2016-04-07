<?php namespace ERA\Controllers;

class HomeController extends \BaseController{
    private $model;

    function __construct() {
        parent::__construct();
        $this->model = new \ERA\Models\HomeModel;
    }

    public function index() {
        //return $this->app->view->make('wellcome');
        return view()
        ->setVars([
            'page' => 'about',
            'title' => 'Anasayfa',
            'content' => 'Merhaba'
        ])
        ->master('main');
    }
}