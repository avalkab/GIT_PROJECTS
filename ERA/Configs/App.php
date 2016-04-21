<?php
$app = App::getInstance();

require_once(__CFG.'Helpers.php');

$app->registerArray([
    'view'      => new View,
    'route'     => new Route,
    'hook'      => Hook::getInstance(),
    'companent' => new Companent
]);

require_once(__ERA.'Helpers/Functions.php');
require_once(__CFG.'Companents.php');

hook()->setIgnores();

require_once(__CFG.'Routes.php');