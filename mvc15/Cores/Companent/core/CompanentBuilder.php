<?php namespace Era\Core\Companent;
class CompanentBuilder extends \Singleton {

    public $packages;

    public function bind($c_name = null, ICompanentBuilder $c_object = null) {
        $this->validICompanent($c_object);
        if ($c_object->validVersion() == false) {
            CompanentBuilderError::getError('version', 'novalid');
        }

        $c_object->validIBuilder();
        $c_object->validABuilder();

        $this->packages = (object)array_merge((array)$this->packages, array(strtolower($c_name) => $c_object));
        return $c_object;
    }

    public function validICompanent($class_obj = null) {
        if (!$class_obj instanceof ICompanent) {
            CompanentBuilderError::getError('AI', 'ICnovalid');
            exit(0);
        }
        return $class_obj;
    }

    public function init($c_name = null) {
        return $this->packages->{$c_name};
    }

    public function __get($key){
        return $this->init($key);
    }
}