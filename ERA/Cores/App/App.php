<?php namespace ERA\Core;

class App extends \Singleton {

    public static $instance = null;

    public $project_name;
    public $project_version;

    public $object_collection = array();

    function __construct($project_name = 'ERA') {
        $this->init();
    }

    public function __get($obj_name = null) {
        if (array_key_exists($obj_name, $this->object_collection)) {
            return $this->object_collection[$obj_name];
        }
    }

    /*
    public static function getInstance() {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public static function cont() {
        return self::$instance;
    }
    */

    public function factory($obj, Array $parameters = null) {
        return sizeof($parameters)==0 ? new $obj : new $obj($parameters);
    }

    public function register($obj_name = null, $obj = null) {
        //$this->{$obj_name} = $obj;
        $this->object_collection[$obj_name] = $obj;
    }

    public function registerArray(Array $objs = null) {
        $this->object_collection = array_merge($this->object_collection, $objs);
    }

    public function setProjectName($name = 'ERA') {
        $this->project_name = $name;
    }

    public function setProjectVersion($version = '1.0.0') {
        $this->project_version = $version;
    }

    private function init() {
        $this->setProjectName();
        $this->setProjectVersion();
    }
}