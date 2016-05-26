<?php

$page_id = 0;
$page_table = 0;

function id($id = null) {
    if (!is_null($id)) {
        $GLOBALS['page_id'] = $id;
    }
    return $GLOBALS['page_id'];
}

function table($table = null) {
    if (!is_null($table)) {
        $GLOBALS['page_table'] = $table;
    }
    return $GLOBALS['page_table'];
}