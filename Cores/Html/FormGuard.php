<?php namespace ERA\Core\Html;

class FormGuard extends \Singleton {

    public $token_status = -1;

    public function protect($type, $token_name) {
        $type = strtoupper($type);
        $token_value = request()->getRequest($type, $token_name);
        if (request()->validMethod($type)) {
            if ($this->validate($token_name, $token_value)) {
                $this->token_status = 1;
            }else{
                $this->token_status = 0;
            }
        }
        return $this->store($token_name);
    }

    public function generate() {
        return md5(uniqid());
    }

    public function validate($token_name, $token_value) {
        return ($_SESSION['tokens'][$token_name] == $token_value) ? 1 : 0;
    }

    public function store($token_name) {
        session_unset();
        return $_SESSION['tokens'][$token_name] = $this->generate();
    }

    public function debug() {
        echo '<pre>';
        print_r( $_SESSION['tokens'] );
        echo '<br>';
        print_r( $_POST );
        echo '</pre>';
    }

}