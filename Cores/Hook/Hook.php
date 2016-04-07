<?php namespace ERA\Core;

class Hook extends \Singleton {
    private $marks = array();
    private $allow_compiled_content = 1;

    public function mark($name) {
        $marks = $this->marks[$name];
        if ($marks) {
            foreach ($marks as $key => $value) {
                $obj = companent()->{$key};
                $fnc = $value['function'];
                $params = (array)$value['parameters'];

                if (method_exists($obj, $fnc)) {
                    if ($params) {
                        $data .= call_user_method_array($fnc, $obj, $params);
                    }else{
                        $data .= call_user_method($fnc, $obj);
                    }
                }
            }
            return $data;
        }
    }

    public function allow_compile($bool = 1) {
        $this->allow_compiled_content = $bool;
    }

    public function isCompile() {
        return $this->allow_compiled_content;
    }

    public function register($name, $function, $single_class, $namespace_class, $parameters = null) {
        $this->marks[$name][strtolower($single_class)] = [
            'class_name' => $single_class,
            'namespace_class_name' => '\\'.$namespace_class,
            'function' => $function,
            'parameters' => $parameters
        ];
    }
}