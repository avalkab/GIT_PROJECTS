<?php namespace ERA\Controllers;

class PostController extends \BaseController {
    private $model;

    protected $parameters = [];

    protected $allowed_have_pages = [
        '/sayfa\\/([a-zA-Z_-]+)/',
        '/yazi\\/([a-zA-Z_-]+)/'
    ];

    function __construct(Array $parameters = null) {
        $this->parameters = $parameters;
        $this->model = new \PostModel();
    }

    public function autoIsHave() {
        $handle = true;
        foreach ($this->allowed_have_pages as $value) {
            if (preg_match($value, __PAGE)) {
                $handle = $this->have();
                break;
            }
        }
        return $handle;
    }

    public function have() {
        return sql()
        ->select('id')
        ->from($this->model->table)
        ->whereGroupAnd([
            ['tur','=',type()],
            ['sef_url','=',sef()]
        ])
        ->query() ? true : false;
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