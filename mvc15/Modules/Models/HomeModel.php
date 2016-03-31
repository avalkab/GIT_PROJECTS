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

    function __construct(){
        $this->setRequestData([
            'first_name'    => 'Erhan',
            'last_name'     => 'Sonmez',
            'age'           => '25',
            'mail'          => 'erhan.sonmez@hotmail.com.tr',
            'nickname'      => 'erhansonmez'
        ]);
        $this->validRequestData();
    }

}