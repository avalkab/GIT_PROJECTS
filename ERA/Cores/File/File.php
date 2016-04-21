<?php namespace ERA\Core;

class File extends \Singleton {

    function __call($method, $params) {
        if (method_exists($this, $method)) {
            return $this->proccess($method, $params);
        }
    }

    public function proccess($method, Array $params = null) {
        if ($this->exist($params[0]) || $method == 'create') {
            return call_user_method_array($method, $this, $params);
        }
    }

    public function delete($filename) {
        if ($this->exist($filename)) {
            return unlink($filename);
        }
    }

    public function create($filename, $chmod = 0777) {
        $t = touch($filename);
        if ($t) {
            chmod($filename, $chmod);
        }
        return $t;
    }

    public function getFileSize($filename) {
        if ($this->exist($filename)) {
            return filesize($filename);
        }
    }

    public function modifiedTime($filename) {
        if ($this->exist($filename)) {
            return filemtime($filename);
        }
    }

    public function set($filename, $data) {
        if ($this->exist($filename)) {
            return file_put_contents($filename, $data);
        }
    }

    public function get($filename) {
        if ($this->exist($filename)) {
            return file_get_contents($filename);
        }
    }

    public function exist($filename = null) {
        return !empty($filename) ?
                    file_exists($filename) ? 1 : 0
                : 0;
    }
}