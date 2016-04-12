<?php namespace ERA\Core\Secure;

class BiometricPassword extends Password {

    private $fingerprint_speeds = array();
    private $fingerprint_speeds_avg = array();

    function __construct($password = null) {
        parent::__construct($password);
        if ($this->getUsable()) {
            // get finger speeds
        }
    }

    public function Level1(Array $fingerprints = null) {
        $this->saveFingerprints(1, $fingerprints);
    }

    public function Level2(Array $fingerprints = null) {
        $this->saveFingerprints(1, $fingerprints);
    }

    public function Level3(Array $fingerprints = null) {
        $this->saveFingerprints(1, $fingerprints);
    }

    private function saveFingerprints(Array $fingerprints = null) {

    }

}