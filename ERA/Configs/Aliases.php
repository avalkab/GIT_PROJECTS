<?php
$paths = [
    /* Cores */
	'App'                   => 'ERA/Cores/App/',
    'Route'                 => 'ERA/Cores/Route/',
	'Bootstrap'             => 'ERA/Cores/Bootstrap/',
    'View'                  => 'ERA/Cores/View/',
    'Hook'                  => 'ERA/Cores/Hook/',
    'File'                  => 'ERA/Cores/File/',
    'Folder'                => 'ERA/Cores/Folder/',
    'IAuth'                 => 'ERA/Cores/Auth/',
    'Auth'                  => 'ERA/Cores/Auth/',
    'User'                  => 'ERA/Cores/Auth/',
    'Slug'                  => 'ERA/Cores/Slug/',
    'Url'                   => 'ERA/Cores/Url/',
    'Html'                  => 'ERA/Cores/Html/',
    'FormGuard'             => 'ERA/Cores/Html/',
    'DB'                    => 'ERA/Cores/DB/',
    'Image'                 => 'ERA/Cores/Image/',
    'Password'              => 'ERA/Cores/Secure/',
    'BiometricPassword'     => 'ERA/Cores/Secure/',
    'Log'                   => 'ERA/Cores/Log/',
    'Request'               => 'ERA/Cores/Request/',
    'Translate'             => 'ERA/Cores/Translate/',


    /* Companents */
    'Companent'             => 'ERA/Cores/Companent/',
    'CompanentBuilder'      => 'ERA/Cores/Companent/core/',
    'ICompanentBuilder'     => 'ERA/Cores/Companent/core/',
    'ACompanentAdapter'     => 'ERA/Cores/Companent/core/',
    'CompanentBuilderError' => 'ERA/Cores/Companent/core/',
    'ICompanent'            => 'ERA/Cores/Companent/core/',

    /* Installed companents */
    'Cache'                 => 'ERA/Companents/Cache/',
    'CommentBlocker'        => 'ERA/Companents/CommentBlocker/',
    'Compress'              => 'ERA/Companents/Compress/',

    /* Controllers */
    'BaseController'        => 'ERA/Bases/',
    'BaseModel'             => 'ERA/Bases/',
    'HomeController'        => 'ERA/Modules/Controllers/',
    'BannerController'      => 'ERA/Modules/Controllers/',
    'CommentsController'    => 'ERA/Modules/Controllers/',
    'PostController'        => 'ERA/Modules/Controllers/',
    'MetaController'        => 'ERA/Modules/Controllers',

    /* Models */
    'HomeModel'             => 'ERA/Modules/Models/',
    'CommentsModel'         => 'ERA/Modules/Models/',

    /* Patterns */
    'Singleton'             => 'ERA/Helpers/Patterns/Singleton/'
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
    'IAuth'                 => '\ERA\Core\Auth\IAuth',
    'Auth'                  => '\ERA\Core\Auth',
    'User'                  => '\ERA\Core\Auth\User',
    'Slug'                  => '\ERA\Core\Slug',
    'Url'                   => '\ERA\Core\Url',
    'Html'                  => '\ERA\Core\Html',
    'FormGuard'             => '\ERA\Core\Html\FormGuard',
    'DB'                    => '\ERA\Core\DB',
    'Image'                 => '\ERA\Core\Image',
    'Password'              => '\ERA\Core\Secure\Password',
    'BiometricPassword'     => '\ERA\Core\Secure\BiometricPassword',
    'Log'                   => '\ERA\Core\Log',
    'Request'               => '\ERA\Core\Request',
    'Translate'             => '\ERA\Core\Translate',


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
    'BannerController'      => '\ERA\Controllers\BannerController',
    'CommentsController'    => '\ERA\Controllers\CommentsController',
    'PostController'        => '\ERA\Controllers\PostController',
    'MetaController'        => '\ERA\Controllers\MetaController',

    /* Models */
    'HomeModel'             => '\ERA\Models\HomeModel',
    'CommentsModel'         => '\ERA\Models\CommentsModel',

    /* Patterns */
    'Singleton'             => '\ERA\Patterns\Singleton'
];