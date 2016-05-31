<?php namespace ERA\Controllers;

class PostController extends \BaseController {
    private $model;

    protected $parameters = [];

    function __construct(Array $parameters = null) {
        $this->parameters = $parameters;
        $this->model = new \PostModel();
    }

    public function all($e = 10, $s = 0, $where = 1, $select = '*') {
        if (!is_array($where)) {
            $where = [1];
        }
        return $this->model->pullAll($e, $s, $where, $select);
    }

    public function one($where = 1, $select = '*') {
        if (!is_array($where)) {
            $where = [1];
        }
        return $this->model->pullOne($where, $select);
    }

    public function id($sef) {
        return $this->model->sefToId($sef);
    }

}