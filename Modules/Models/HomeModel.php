<?php namespace ERA\Models;

class HomeModel extends \BaseModel {

    protected $request_method = 'POST';
    protected $table = 'users';

    protected $fillable = [
        'first_name'    => ['type' => 'str',      'min' => 2, 'max' => 30],
        'last_name'     => ['type' => 'str',      'min' => 2, 'max' => 30],
        'age'           => ['type' => 'int',      'min' => 2, 'max' => 2],
        'mail'          => ['type' => 'mail',     'min' => 8, 'max' => 30],
        'nickname'      => ['type' => 'username', 'min' => 6, 'max' => 14]
    ];

    /*
    function __construct() {
        parent::__construct();

        $this->validRequestData();
    }
    */

}