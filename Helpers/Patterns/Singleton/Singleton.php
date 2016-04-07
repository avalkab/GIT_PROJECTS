<?php namespace ERA\Patterns;

class Singleton {
    protected static $instance = [];

    public static function getInstance() {
        $called = get_called_class();
        if (null == static::$instance[$called]) {
            static::$instance[$called] = new static;
        }
        return static::$instance[$called];
    }
}