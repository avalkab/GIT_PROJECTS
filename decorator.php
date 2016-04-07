<?php error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

require_once('Configs/Start.php');

echo Url::make('haber-detay', [Slug::make('Diyarbakır saldırısında kullanılan araç PKK\'nın tehdidiyle ihaleden çekilen müteahhit çıktı')]);

?>

<hr>

<?php $app->debug(); ?>