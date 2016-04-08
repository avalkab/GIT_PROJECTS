<?php namespace ERA\Controllers;

class UserController extends \Auth {

    function __construct() {
        $this->prepare(
            'GET',
            'users',
            [
                'username' => ['type' => 'str', 'min' => 2, 'max' => 30 ],
                'password' => ['type' => 'str', 'min' => 2, 'max' => 30, 'hash' => true ]
            ]
        );
        $this->buildLoginSql(['*'], ['username' => 'username', 'password_md5' => 'password']);
    }

}