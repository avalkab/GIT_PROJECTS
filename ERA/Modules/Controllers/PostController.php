<?php namespace ERA\Controllers;

class PostController extends \BaseController {
    function __construct() {
    }

    private function getStruct(Array $parameters = null) {
        return "SELECT ".$parameters['columns']."
            FROM ".$parameters['table']."
            ".$parameters['where']."
            LIMIT 1";
    }

    private function getSingleRow(Array $parameters = null) {
        return db()->get_row($this->getStruct($parameters));
    }

    private function getSingleRowVar(Array $parameters = null) {
        return db()->get_var($this->getStruct($parameters));
    }

    public function getPostTitle($post_id, $table) {
        return $this->getSingleRowVar([
                'columns' => 'baslik',
                'table' => $table,
                'where' => 'WHERE id = '.$post_id
            ]);
    }
}