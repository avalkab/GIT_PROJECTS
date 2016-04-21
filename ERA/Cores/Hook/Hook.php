<?php namespace ERA\Core;

class Hook extends \Singleton {
    private $events = array();
    private $marks = array();
    private $allow_compiled_content = 1;
    private $compiled_events = array();

    private $ignore_collection = array();

    private $current_page;

    public function setCurrentPage($page) {
        $this->current_page = $page;
    }

    public function setIgnores() {
        $this->ignore_collection = require_once(__CFG.'HookIngores.php');
    }

    public function isIgnore() {
        return in_array($this->current_page, $this->ignore_collection) ? true : false;
    }

    public function mark($name) {
        if ($this->isIgnore() === true) {
            return false;
        }
        $marks = $this->marks[$name];
        if ($marks) {
            foreach ($marks as $key => $value) {
                $obj = companent()->{$key};
                $fnc = $value['function'];
                $params = (array)$value['parameters'];
                $compiled_key = $key.$fnc;
                if (!in_array($compiled_key, $this->compiled_events)) {
                    if (!isset($value['is_fnc'])) {
                        if ($params) {
                            $data .= call_user_method_array($fnc, $obj, $params);
                        }else{
                            $data .= call_user_method($fnc, $obj);
                        }
                    } else if($value['is_fnc']) {
                        if ($params) {
                            $data .= call_user_func_array($fnc, $params);
                        }else{
                            $data .= call_user_func($fnc);
                        }
                    }
                    $this->compiled_events[] = $compiled_key;
                }
            }
            return $data;
        }
    }

    public function allowCompile($bool = 1) {
        $this->allow_compiled_content = $bool;
    }

    public function isCompile() {
        return $this->allow_compiled_content;
    }

    public function setEvent($name, $function, Array $parameters = null) {
        if (function_exists($function)) {
            $this->marks[$name][] = [
                'is_fnc' => 1,
                'function' => $function,
                'parameters' => $parameters
            ];
        }
    }

    public function register($name, $function, $single_class, $namespace_class, Array $parameters = null) {
        foreach ((array)$function as $value) {
            if (method_exists($namespace_class, $value)) {
                $this->marks[$name][strtolower($single_class)] = [
                    'class_name' => $single_class,
                    'namespace_class_name' => '\\'.$namespace_class,
                    'function' => $value,
                    'parameters' => $parameters
                ];
            }
        }
    }
}