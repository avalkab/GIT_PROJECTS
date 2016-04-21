<?php namespace ERA\Core;

class Translate extends \Singleton {

    const DEFAULT_LANG = 'tr';
    const LANG_FILE = 'vars.php';

    private $language_keys;

    function __construct(Array $parameters = null) {
        $this->load($parameters['language']);
    }

    public function load($foldername = null) {
        $foldername = isset($foldername) ? $foldername : self::DEFAULT_LANG;
        $path = __ROOT . 'Langs/'.$foldername.'/'.(self::LANG_FILE);
        if (\File::exist($path)) {
            $this->language_keys = require_once($path);
        }else{
            exit('Language file could not be loaded.');
        }
    }

    public function getVar($key) {
        return $this->language_keys[$key];
    }
}