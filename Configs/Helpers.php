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