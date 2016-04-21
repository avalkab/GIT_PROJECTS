<?php
$app = App::getInstance();

require_once('Helpers.php');

$app->registerArray([
    'view'      => new View,
    'route'     => new Route,
    'hook'      => Hook::getInstance(),
    'companent' => new Companent
]);

require_once(__ROOT.'Helpers/Functions.php');
require_once('Companents.php');

hook()->setIgnores();

require_once('Routes.php');