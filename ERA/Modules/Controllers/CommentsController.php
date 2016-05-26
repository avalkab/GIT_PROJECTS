<?php namespace ERA\Controllers;

class CommentsController extends \BaseController{
    private $model;

    function __construct() {
    }

    public function getComments(Array $parameters = null) {
        return db()->get_results("
            SELECT ".$parameters['cols']."
            FROM view_yorumlar
            ".$parameters['where']."
            ORDER by id DESC
            LIMIT ".$parameters['limit']."
        ");
    }
}