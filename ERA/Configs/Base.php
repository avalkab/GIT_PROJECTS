<?php

$page_id = 0;
$page_sef = 0;
$page_type = 0;

function id($id = null) {
    if (!is_null($id)) {
        $GLOBALS['page_id'] = $id;
    }
    return $GLOBALS['page_id'];
}

function sef($sef = null) {
    if (!is_null($sef)) {
        $GLOBALS['page_sef'] = $sef;
    }
    return $GLOBALS['page_sef'];
}

function type($type = null) {
    if (!is_null($type)) {
        $GLOBALS['page_type'] = $type;
    }
    return $GLOBALS['page_type'];
}