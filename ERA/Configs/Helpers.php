<?php

function app() {
    return $GLOBALS['app'];
}

function view() {
    return app()->view;
}

function route() {
    return app()->route;
}

function hook() {
    return app()->hook;
}

function companent() {
    return app()->companent;
}

function db() {
    return DB::getInstance()->db;
}

function logger() {
    return Log::getInstance();
}

function request() {
    return Request::getInstance();
}

function html() {
    return Html::getInstance();
}

function mailer() {
    return new Mail;
}

function sql() {
    return new SqlBuilder();
}


function post(Array $parameters = null) {
    return app()->factory('PostController', $parameters);
}

function meta() {
    return app()->factory('MetaController');
}

function comment() {
    return app()->factory('CommentsController');
}

function __404() {
    exit(view()->error('404'));
}

function translate($key) {
    if (!is_string($key)) {
        return false;
    }
    return Translate::getInstance(['language' => 'tr'])->getVar($key);
}

function assets($file = null) {
    return __WEBROOTPUB.'assets/'.$file;
}

function dater($date) {
    $months = ['01'=>'Ocak', '02'=>'Şubat', '03'=>'Mart', '04'=>'Nisan', '05'=>'Mayıs', '06'=>'Haziran', '07'=>'Temmuz', '08'=>'Ağustos', '09'=>'Eylül', '10'=>'Ekim', '11'=>'Kasım', '12'=>'Aralık'];
    $date_exp = explode(' ',$date);
    $date_digits = explode('-', $date_exp[0]);
    $time_digits = explode(':', $date_exp[1]);
    echo $date_digits[2].' '.$months[$date_digits[1]].' '.$date_digits[0].' '.$time_digits[0].':'.$time_digits[1];
}

function img($file) {
    echo __UPLOADS.$file;
}