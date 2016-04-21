<?php namespace ERA\Core;

class Log extends \Singleton {

    public $file;
    public $folder;

    function __construct() {
        $this->file = new File;
        $this->folder = new Folder;
    }
    public function logFolder() {
        return __ROOT.'Storages/logs/';
    }

    public function today() {
        return date('dmYH');
    }

    public function todayFolder() {
        return $this->logFolder().$this->today().'/';
    }

    public function totimeFile() {
        return $this->todayFolder().'log-'.(time()).'.log';
    }

    public function set($log_text = null) {
        $this->folder->create($this->todayFolder());
        $this->file->create($this->totimeFile());
        $this->file->set($this->totimeFile(), $log_text);
    }

}