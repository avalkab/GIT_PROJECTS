<?php namespace ERA\Core;

class Input extends \Singleton {

    /* GET */
    public function getRequestData($type, $key = null) {
        switch ($type) {
            case 'POST'     : $data = is_string($key) ? $_POST[$key] : $_POST; break;
            case 'GET'      : $data = is_string($key) ? $_GET[$key] : $_GET; break;
            case 'REQUEST'  : $data = is_string($key) ? $_REQUEST[$key] : $_REQUEST; break;
        }
        return $data;
    }

    public function post($key = null) {
        return $this->getRequestData('POST', $key);
    }

    public function get($key = null) {
        return $this->getRequestData('GET', $key);
    }

    public function request($key = null) {
        return $this->getRequestData('REQUEST', $key);
    }

}