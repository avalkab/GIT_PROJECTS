<?php namespace ERA\Patterns;

class Singleton {
    public static $instance = null;
    public static function getInstance() {
        if (null == static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}