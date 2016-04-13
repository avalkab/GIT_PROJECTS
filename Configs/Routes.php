<?php

/* ANASAYFA */
//$app->route->get('/', 'HomeController:index');
$app->route->get('/', function($id) {
    echo $id;
    return view()->setVar('page_title', 'Anasayfa')->main('home', 'main');
});

/* AJAX */
$app->route->get('ajax?proccess={str}', function($proccess) {
    return $proccess;
});

/* MAİL */
$app->route->get('mail', function() {
    return view()->setVars([
               'mail_title' => 'Sitemize Hoşgeldiniz!',
               'mail_content' => 'Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. '
           ])->mail('mail');
});

/* HAKKIMIZDA */
$app->route->get('welcome{opt}', function($name) {
    return view()->setVar('ad', $name)->make('welcome');
});

/* HABER DETAY */
$app->route->get('haber-detay/{int}/{any}', function($id, $sef) {
    return view()->setVars(['id' => $id, 'sef' => $sef])->page('news-detail');
});

/* 404 */
$app->route->get('404', function() {
    return view()->error('404');
});

/* ARAMA */
$app->route->post('arama', function() {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
});

$app->route->run();