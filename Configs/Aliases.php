<?php
$paths = [
    /* Cores */
	'App'                   => 'Cores/App/',
    'Route'                 => 'Cores/Route/',
	'Bootstrap'             => 'Cores/Bootstrap/',
    'View'                  => 'Cores/View/',
    'Hook'                  => 'Cores/Hook/',
    'File'                  => 'Cores/File/',
    'Folder'                => 'Cores/Folder/',
    'Auth'                  => 'Cores/Auth/',
    'IAuth'                 => 'Cores/Auth/',
    'Slug'                  => 'Cores/Slug/',
    'Url'                   => 'Cores/Url/',
    'Html'                  => 'Cores/Html/',
    'DB'                    => 'Cores/DB/',
    'Image'                 => 'Cores/Image/',
    'Password'              => 'Cores/Secure/',
    'BiometricPassword'     => 'Cores/Secure/',
    'Log'                   => 'Cores/Log/',
    'Request'               => 'Cores/Request/',


    /* Companents */
    'Companent'             => 'Cores/Companent/',
    'CompanentBuilder'      => 'Cores/Companent/core/',
    'ICompanentBuilder'     => 'Cores/Companent/core/',
    'ACompanentAdapter'     => 'Cores/Companent/core/',
    'CompanentBuilderError' => 'Cores/Companent/core/',
    'ICompanent'            => 'Cores/Companent/core/',

    /* Installed companents */
    'Cache'                 => 'Companents/Cache/',
    'CommentBlocker'        => 'Companents/CommentBlocker/',
    'Compress'              => 'Companents/Compress/',

    /* Controllers */
    'BaseController'        => 'Bases/',
    'BaseModel'             => 'Bases/',
    'HomeController'        => 'Modules/Controllers/',
    'User'                  => 'Modules/Controllers/',

    /* Models */
    'HomeModel'             => 'Modules/Models/',

    /* Patterns */
    'Singleton'             => 'Helpers/Patterns/Singleton/'
];

$alias = [
    /* Cores */
    'App'                   => '\ERA\Core\App',
    'Route'                 => '\ERA\Core\Route',
    'Bootstrap'             => '\ERA\Core\Bootstrap',
    'View'                  => '\ERA\Core\View',
    'Hook'                  => '\ERA\Core\Hook',
    'File'                  => '\ERA\Core\File',
    'Folder'                => '\ERA\Core\Folder',
    'Auth'                  => '\ERA\Core\Auth',
    'IAuth'                 => '\ERA\Core\Auth\IAuth',
    'Slug'                  => '\ERA\Core\Slug',
    'Url'                   => '\ERA\Core\Url',
    'Html'                  => '\ERA\Core\Html',
    'DB'                    => '\ERA\Core\DB',
    'Image'                 => '\ERA\Core\Image',
    'Password'              => '\ERA\Core\Secure\Password',
    'BiometricPassword'     => '\ERA\Core\Secure\BiometricPassword',
    'Log'                   => '\ERA\Core\Log',
    'Request'               => '\ERA\Core\Request',


    /* Companents */
    'Companent'             => '\ERA\Core\Companent',
    'CompanentBuilder'      => '\ERA\Core\Companent\CompanentBuilder',
    'ICompanentBuilder'     => '\ERA\Core\Companent\ICompanentBuilder',
    'ACompanentAdapter'     => '\ERA\Core\Companent\ACompanentAdapter',
    'CompanentBuilderError' => '\ERA\Core\Companent\CompanentBuilderError',
    'ICompanent'            => '\ERA\Core\Companent\ICompanent',

    /* Installed companents */
    'Cache'                 => '\ERA\Companents\Cache',
    'CommentBlocker'        => '\ERA\Companents\CommentBlocker',
    'Compress'              => '\ERA\Companents\Compress',

    /* Controllers */
    'BaseController'        => '\ERA\Bases\BaseController',
    'BaseModel'             => '\ERA\Bases\BaseModel',
    'HomeController'        => '\ERA\Controllers\HomeController',
    'User'                  => '\ERA\Controllers\UserController',

    /* Models */
    'HomeModel'             => '\ERA\Models\HomeModel',

    /* Patterns */
    'Singleton'             => '\ERA\Patterns\Singleton'
];