<?php namespace ERA\Companents;
class Compress extends \ACompanentAdapter implements \ICompanent {
    public $version = '1.0.0';

    public function start() {
        route()->setResponse($this->pressIt());
    }

    public function end() {
        route()->getResponse();
    }

    public function pressIt() {
        return preg_replace('/\s+/', ' ', route()->getResponse());
    }

}
