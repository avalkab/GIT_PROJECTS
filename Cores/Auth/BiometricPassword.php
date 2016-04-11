<?php namespace ERA\Core\Auth;

class Password {

    protected $password_str = null;
    protected $password_level = 0;

    protected $error_code = 0;

    private $usable = false;

    function __construct($password_str = null) {
        $this->password_str = $password_str;
        $this->isProtected();
    }

    public function isProtected() {
        try {
            if ($this->isCount() == false) { throw new Exception(0); }
            if ($this->isSpace() == false) { throw new Exception(1); }
            if ($this->isNumeric() == false) { throw new Exception(2); }
            if ($this->isLower() == false) { throw new Exception(3); }
            if ($this->isUpper() == false) { throw new Exception(4); }
            if ($this->isSpecials() == false) { throw new Exception(5); }
            $this->usable = true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }
        return $this->error;
    }

    protected function isCount() {
        $pass_str = strlen($this->password_str);
        return ($pass_str >= 8 && $pass_str <= 32) ? 1 : 0;
    }

    protected function isSpace() {
        return preg_match('/\s/', $this->password_str) ? 0 : 1;
    }

    protected function isNumeric() {
        return preg_match('/[0-9]/', $this->password_str) ? 1 : 0;
    }

    protected function isLower() {
        return preg_match('/[a-z]/', $this->password_str) ? 1 : 0;
    }

    protected function isUpper() {
        return preg_match('/[A-Z]/', $this->password_str) ? 1 : 0;
    }

    protected function isSpecials() {
        return preg_match('/[a-zA-Z0-9]+/i',$this->password_str) ? 1 : 0;
    }

    protected function getUsable() {
        return $this->usable ? true : false;
    }

}

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


new BiometricPassword('123');