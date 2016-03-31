<?php namespace ERA\Bases;
class BaseController{
    protected $app;
    function __construct() {
        $this->app = $GLOBALS['app'];
    }
}