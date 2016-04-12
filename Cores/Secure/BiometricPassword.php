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

}