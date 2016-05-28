<?php

/* AJAX */
$app->route->post('ajax/{str}', function($type) {
    switch ($type) {
        case 'passwordValidator':
            $usable = Password::valid($_POST['password']);
            if ($usable === true) {
                return 'ok';
            }else{
                return Password::getError();
            }
        break;

        case 'login':
            $user = new User;
            return $user->login();
        break;

        case 'logout':
            $user = new User;
            $user->logout();
        break;
    }
});

/* ANASAYFA */
//$app->route->get('/', 'HomeController:index');
$app->route->any('/', function() {
    return view()->setVar('page_title', 'Anasayfa')->main('home', 'main');
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

/* Sayfa */
$app->route->get('sayfa/{str}', function($sef) {
    return view()->setVars(['sef' => $sef])->page('news-detail');
});

/* 404 */
$app->route->get('404', function() {
    return view()->error('404');
});

/* ARAMA */
$app->route->get('arama', function() {
    html()->guard->protect('GET', 'headerSearchToken');
    $status = html()->guard->getTokenStatus();

    echo '<pre>';
    print_r( $_GET );
    print_r( $_SESSION );
    print_r( route() );
    echo '</pre>';
});