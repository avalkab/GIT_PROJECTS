<?php

/* Ajax */
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

        case 'newComment':
            echo comment()->newComment();
        break;

        case 'subscribe':
            $phone = request()->post('phone');
            $number_regex = '/^0[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/';
            if (preg_match($number_regex, $phone)) {
                $phone = str_replace('-', '', $phone);
                if (!sql()->select('id')->from('abonelikler')->where(['numara', '=', $phone])->query()) {
                    sql()->insert('abonelikler')->set([['numara', $phone]])->query();
                    echo 1;
                }else{
                    echo 3;
                }
            }else{
                echo 2;
            }
        break;
    }
});

/* Anasayfa */
//$app->route->get('/', 'HomeController:index');
$app->route->any('/', function() {
    return view()->main('anasayfa');
});

/* Sayfa */
$app->route->get('sayfa/{str}', function($sef) {
    return view()->setVars(['sef'=>$sef,'page_type'=>'sayfa'])->sit()->main('sayfa-detay');
});

/* Yazı */
$app->route->get('yazi/{str}', function($sef) {
    return view()->setVars(['sef'=>$sef,'page_type'=>'yazi'])->sit()->main('yazi-detay');
});

/* Mail */
$app->route->get('mail', function() {
    return view()->mail('mail');
});

/* Hakkımızda */
$app->route->get('welcome{opt}', function($name) {
    return view()->setVar('ad', $name)->make('welcome');
});

/* 404 */
$app->route->get('404', function() {
    __404();
});

/* Arama */
$app->route->get('arama', function() {
    html()->guard->protect('GET', 'headerSearchToken');
    $status = html()->guard->getTokenStatus();

    echo '<pre>';
    print_r( $_GET );
    print_r( $_SESSION );
    print_r( route() );
    echo '</pre>';
});