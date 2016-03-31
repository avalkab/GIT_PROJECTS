<?php error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT); //namespace ERA\Core\App\Bootstrap;

require_once('Configs/Start.php');

$app = App::getInstance();

$app->registerArray([
    'hook' => Hook::getInstance(),
    'route' => new Route,
    'template' => new Template,
    'companent' => new Companent
]);

$app->companent->bind('Cache', new Cache);
$app->companent->bind('CommentBlocker', new CommentBlocker);

/* ANASAYFA */
//$app->route->get('/', 'HomeController:index');
$app->route->get('/', function() use($app) {
    return $app->template->setVar('page_title', 'Anasayfa')->master('home');
});

/* MAİL */
$app->route->get('mail', function() use($app) {
    return $app->template
           ->setVars([
               'mail_title' => 'Sitemize Hoşgeldiniz!',
               'mail_content' => 'Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. '
           ])->mail('mail');
});

/* HAKKIMIZDA */
$app->route->get('welcome{opt}', function($name) use($app) {
    return $app->template->setVar('ad', $name)->make('welcome');
});

/* HABER DETAY */
$app->route->get('haber-detay/{int}/{any}', function($id, $sef) use($app) {
    return $app->template->setVars(['id' => $id, 'sef' => $sef])->master('news-detail');
});

/* 404 */
$app->route->get('404', function() use ($app) {
    return $app->template->error('404');
});

/* ARAMA */
$app->route->post('arama', function() use ($app) {
    print_r($_POST);
});

$app->route->run();

?>

<hr>

<?php $app->debug(); ?>