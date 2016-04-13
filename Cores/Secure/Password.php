<?php namespace ERA\Core\Secure;

class Password extends \Singleton {

    const CHARSET = 'abcdefgijklmnoprstuvyzABCDEFGUVYZOPRSTUVYZ+[*?{^]$(<=!>|}:)-';

    const PATTERN_SPACE = '/[[:space:]]/';
    const PATTERN_NUMERIC = '/[[:digit:]]/';
    const PATTERN_LOWER = '/[[:lower:]]/';
    const PATTERN_UPPER = '/[[:upper:]]/';
    const PATTERN_SPECIALS = '/[[:punct:]]/';
    const PATTERN_TR = '/[ÇŞĞÜÖİçşğüöı]/';

    protected $password_str = null;
    protected $password_strong_level = 0;

    private $error_code = 0;
    private $usable = false;

    /*
    private function __construct($password_str) {
        $this->generate($password_str);
    }
    */

    public static function generate($length = 10) {
        $stack = str_shuffle(self::CHARSET);
        $len = strlen($stack)-1;
        for ($i=0; $i<$length; $i++) {
            $password .= substr($stack, rand(0, $len), 1);
        }
        return $password;
    }

    public static function valid($password_str) {
        self::getInstance()->password_str = $password_str;
        self::getInstance()->isProtected();
        return self::getInstance()->check();
    }

    public function isProtected() {
        try {
            if ($this->isCount() == false) { throw new \Exception(0); }
            if ($this->isSpace() == false) { throw new \Exception(1); }
            if ($this->isLower() == false) { throw new \Exception(2); }
            if ($this->isUpper() == false) { throw new \Exception(3); }
            if ($this->isNumeric() == false) { throw new \Exception(4); }
            if ($this->isSpecials() == false) { throw new \Exception(5); }
            if ($this->isTr() == false) { throw new \Exception(6); }
            $this->usable = true;
        } catch (\Exception $e) {
            $this->error_code = $e->getMessage();
        }
        return $this->error_code;
    }

    protected function isCount() {
        $pass_str = strlen($this->password_str);
        return ($pass_str >= 8 && $pass_str <= 32) ? 1 : 0;
    }

    protected function isSpace() {
        return preg_match(self::PATTERN_SPACE, $this->password_str) ? 0 : 1;
    }

    protected function isNumeric() {
        return preg_match(self::PATTERN_NUMERIC, $this->password_str) ? 1 : 0;
    }

    protected function isLower() {
        return preg_match(self::PATTERN_LOWER, $this->password_str) ? 1 : 0;
    }

    protected function isUpper() {
        return preg_match(self::PATTERN_UPPER, $this->password_str) ? 1 : 0;
    }

    protected function isSpecials() {
        return preg_match(self::PATTERN_SPECIALS, $this->password_str) ? 1 : 0;
    }

    protected function isTr() {
        return preg_match(self::PATTERN_TR, $this->password_str) ? 0 : 1;
    }

    public static function getError() {
        return json_encode(['error' => self::getInstance()->error_code]);
    }

    public function check() {
        return ($this->usable) ? true : false;
    }

}