<?php

	define('__SERVER',         $_SERVER['HTTP_HOST'] !== 'localhost' ? 1 : 0);

    define('__SERVERNAME',      $_SERVER['SERVER_NAME']);

    define('__REF',             $_SERVER['HTTP_REFERER']);

    define('__REQ',             $_SERVER['REQUEST_URI']);

    define('__QSTR',            $_SERVER['QUERY_STRING']);

    define('__WORK',            str_replace(array('private/admin/','decorator.php','index.php','/config','/public','/app'), '', $_SERVER['SCRIPT_NAME']));

    define('__ROOT',            str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . __WORK));

    define('__ERA',             __ROOT.'ERA/');

    define('__CFG',             __ERA.'Configs/');

    define('__CACHE',           __ERA.'Storages/caches/');

    define('__LANG',            __ERA.'Langs/');

    define('__COMPANENT',       __ERA.'Companents/');

    define('__WEBROOT',         'http://' . __SERVERNAME . __WORK);

    define('__WEBROOTPUB',      __WEBROOT.'public/' );

    define('__UPLOADS',         __WEBROOT.'public/uploads/' );

    define('__PAGE',            str_replace(__WORK, '' , parse_url(__REQ)['path']));

    define('__IP__', $_SERVER['REMOTE_ADDR'] == '::1' ? '127.0.0.1' : $_SERVER['REMOTE_ADDR']);

    define('__USERAGENT__', $_SERVER['HTTP_USER_AGENT']);

    define('__REFERER__', $_SERVER['HTTP_REFERER']);

    define('__CURRENTDATE__', date('Y-m-d'));

    define('__TIME__', date('H:i:s'));

    define('__CURRENT__', (__CURRENTDATE__).' '.(__TIME__));