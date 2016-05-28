<?php namespace ERA\Controllers;

class CommentsController extends \BaseController{
    protected $model;

    function __construct() {
        $this->model = new \CommentsModel();
    }

    public static function getInstance() {
        return new self;
    }

    public function first($end = 5, $start = 0, $where = null, $select = null) {
        return $this->model->pull('LIMIT '.$start.','.$end, 'ORDER by id ASC', $where, $select);
    }

    public function last($end = 5, $start = 0, $where = null, $select = null) {
        return $this->model->pull('LIMIT '.$start.','.$end, 'ORDER by id DESC', $where, $select);
    }

}