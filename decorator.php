<?php error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

require_once('Configs/Start.php');

$auth = new Auth(
    'POST',
    'users',
    [
        'username' => [
            'type' => 'str',
            'min' => 2,
            'max' => 30
        ],
        'password' => [
            'type' => 'str',
            'min' => 2,
            'max' => 30
        ]
    ]
);

print_r($auth);

?>

<hr>

<?php $app->debug(); ?>