<?php

    require_once('Constants.php');
    require_once('Aliases.php');

    function __autoload($class) {
        global $paths, $alias;
        $pure_class = end(explode('\\', $class));
        $file = __ROOT.$paths[$pure_class].$pure_class.'.php';
        if (file_exists($file)) {
            include_once($file);
            class_alias($alias[$pure_class], $pure_class);
        }
    }
