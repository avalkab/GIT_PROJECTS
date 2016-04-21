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

function translate($key) {
    if (!is_string($key)) {
        return false;
    }
    return Translate::getInstance(['language' => 'tr'])->getVar($key);
}
