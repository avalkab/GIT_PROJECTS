<?php

    require_once('Constants.php');
    require_once('Aliases.php');

    function autoload($class) {
        global $paths, $alias;
        $pure_class = end(explode('\\', $class));
        $file = __ROOT.$paths[$pure_class].$pure_class.'.php';
        if (file_exists($file)) {
            include_once($file);
            class_alias($alias[$pure_class], $pure_class);
        }
    }

    function autoload_dbfinder($class) {
        $file = __ROOT.'Cores/DbFinder/lib/'.$class.'.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }

    spl_autoload_register('autoload');
    spl_autoload_register('autoload_dbfinder');
