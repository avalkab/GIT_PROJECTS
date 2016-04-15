<?php namespace ERA\Controllers;

class UserController extends \Auth {
    function __construct() {
        $this->prepare(
            'POST',
            'kullanicilar',
            [
                'username' => ['type' => 'str', 'min' => 2, 'max' => 30 ],
                'password' => ['type' => 'str', 'min' => 2, 'max' => 30, 'hash' => true, 'password' => true ]
            ]
        );
        $this->buildLoginSql(
            ['*'],
            [
                'username' => 'username',
                'sifre_hash' => 'password'
            ]
        );
    }

    public static function member() {
        $sub_class = new self;
        return $sub_class->getMember();
    }
}