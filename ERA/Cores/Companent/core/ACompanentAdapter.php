<?php namespace Era\Core\Companent;

abstract class ACompanentAdapter implements \ICompanentBuilder {

    protected $version = '0.0.0';
    protected $called_class;
    protected $settings = array();

    function __construct() {
        $this->called_class = get_called_class();
        $this->getSettings();
    }

    protected function _var($name) {
        return view()->getVar($name);
    }

    public function getCallesClass() {
        return $this->called_class;
    }

    public function setVersion($version = '0.0.0') {
        $this->version = $version;
        if ($this->validVersion() == false) {
            CompanentBuilderError::getError('version','setnovalid');
            exit(0);
        }
    }

    protected function getSettings() {
        $class_name = end(explode('\\', $this->called_class));
        $file = $GLOBALS['paths'][$class_name].'Settings.php';

        if (file_exists($file)) {
            $this->settings = require_once($file);
        }

        if (isset($this->settings['events'])) {
            foreach ($this->settings['events'] as $key => $value) {
                hook()->register($key, $value, $class_name, $this->called_class);
            }
        }
    }

    public function getVersion() {
        if ($this->validVersion() == false) {
            CompanentBuilderError::getError('version','getnovalid');
            exit(0);
        }
        return $this->version;
    }

    public function compareVersion($version = '0.0.0') {
        $ver = $this->getVersion();
        if ($ver != false) {
            if (version_compare($ver, $version, '>=')) {
                CompanentBuilderError::getError('compare','updated');
            }else{
                CompanentBuilderError::getError('compare','available').$version;
            }
        }
    }

    public function validVersion() {
        return ($this->version != '0.0.0' && preg_match('/^[0-9]{0,3}.[0-9]{0,3}.[0-9]{0,3}$/', $this->version)) ? true : false;
    }

    public function validIBuilder() {
        if (!interface_exists('ICompanentBuilder')) {
            CompanentBuilderError::getError('AI','I');
            exit(0);
        }
    }

    public function validABuilder() {
        if (!class_exists('ACompanentAdapter')) {
            CompanentBuilderError::getError('AI','A');
            exit(0);
        }
    }
}