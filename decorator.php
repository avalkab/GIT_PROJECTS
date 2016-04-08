<?php error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

require_once('Configs/Start.php');

$uc = new User;
print_r($uc);

?>

<hr>

<?php $app->debug(); ?>