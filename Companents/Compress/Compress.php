<?php namespace ERA\Companents;
class Compress extends \ACompanentAdapter implements \ICompanent {
    public $version = '1.0.0';

    private function running() {
        return $this->settings['running'];
    }

    public function start() {
        route()->setResponse($this->pressIt());
    }

    public function end() {
        route()->getResponse();
    }

    private function pressIt() {
        return $this->running() ? preg_replace('/\s+/', ' ', route()->getResponse()) : route()->getResponse();
    }

}
