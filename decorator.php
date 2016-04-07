<?php error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

require_once('Configs/Start.php');

echo Auth::userId();

?>

<hr>

<?php $app->debug(); ?>