<?php namespace ERA\Core;

class Hook extends \Singleton {
    private $marks = array();
    private $allow_compiled_content = 1;

    public static function mark($name) {
        $app = $GLOBALS['app'];
        $marks = self::$instance->marks[$name];
        if ($marks) {
            foreach ($marks as $key => $value) {
                $obj = $app->companent->{$key};
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

    public static function allow_compile($bool = 1) {
        self::$instance->allow_compiled_content = $bool;
    }

    public static function isCompile() {
        return self::$instance->allow_compiled_content;
    }

    public static function register($name, $function, $single_class, $namespace_class, $parameters = null) {
        self::$instance->marks[$name][strtolower($single_class)] = [
            'class_name' => $single_class,
            'namespace_class_name' => '\\'.$namespace_class,
            'function' => $function,
            'parameters' => $parameters
        ];
    }
}