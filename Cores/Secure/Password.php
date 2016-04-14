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

    private $error_code = -1;
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
        return self::getInstance()->error_code;
    }

    public function check() {
        return ($this->usable) ? true : false;
    }

    public static function createElement($name = 'password', $url, $jquery = true) {
        if ($jquery == true) {
            echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>';
        }
        echo '<div id="ajax_password_wrapper" style="position:relative; width:200px;">
            <div style="position:relative; width:100%; height:2px; overflow:hidden;">
            <div id="ajax_password_mask" style="position:absolute; left:0; top:0; width:100%; height:100%; background-color:#ccc;z-index:999;"></div>
            <span style="position:absolute; left:0; top:0; width:100%; height:100%;
            background: #ff0000;
            background: -moz-linear-gradient(left,  #ff0000 0%, #ff9900 50%, #00ff7f 100%);
            background: -webkit-linear-gradient(left,  #ff0000 0%,#ff9900 50%,#00ff7f 100%);
            background: linear-gradient(to right,  #ff0000 0%,#ff9900 50%,#00ff7f 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ff0000", endColorstr="#00ff7f",GradientType=1 );
            "></span>
            </div>
            <input id="ajax_password" style="width:100%; border:1px solid #ccc; background-color:#f5f5f5; padding:4px 9px; outline:0; box-sizing:border-box;" type="password" name="'.$name.'">
        </div>';
        echo '<script type="text/javascript">
        $(document).ready(function(){

            var ajax_password_input = $("#ajax_password");
            ajax_password_input.on("keyup", function(e) {
                $.ajax({
                    method : "POST",
                    url : "http://localhost/dev/mvc/decorator.php?param='.$url.'",
                    data : {
                        password : ajax_password_input.val()
                    },
                    success: function(response) {
                        $("#ajax_password_wrapper_message").remove();
                        $("#ajax_password_mask").animate({ marginLeft : "100%" }, 50);
                        if ("ok" == response) {
                            $("#ajax_password_wrapper").append("<strong id=\"ajax_password_wrapper_message\" style=\"position:absolute; width:16px; height:16px; right:4px;top:5px;text-align:center;background-color:#0f3; color:#fff; line-height:16px;font-size:11px; border-radius:50%;text-indent:-2px;\">✓</strong>");
                            $("#ajax_password_mask").animate({ marginLeft : "100%" }, 50);
                        }else{
                            $("#ajax_password_wrapper").append("<strong id=\"ajax_password_wrapper_message\" style=\"position:absolute; width:16px; height:16px; right:4px;top:5px;text-align:center;background-color:#f30; color:#fff; line-height:14px;font-size:11px; border-radius:50%;text-indent:0;\">x</strong>");
                            $("#ajax_password_mask").animate({ marginLeft : (response*30)+"px" }, 50);
                        }
                    }
                });
            });
        });
        </script>';
    }

}