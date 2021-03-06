<?php namespace ERA\Patterns;

class Singleton {
    protected static $instance = [];

    public static function getInstance(Array $parameters = null) {
        $called = get_called_class();
        if (null == static::$instance[$called]) {
            static::$instance[$called] = sizeof($parameters)>0 ? new static($parameters) : new static;
        }
        return static::$instance[$called];
    }

    public static function setInstance($class_name, Array $parameters = null) {
        return static::$instance[$class_name] = sizeof($parameters)>0 ? new static($parameters) : new static;
    }
}