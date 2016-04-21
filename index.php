<?php error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

require_once('ERA/Configs/Start.php');

$app->route->run();

?>