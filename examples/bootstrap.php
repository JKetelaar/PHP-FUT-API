<?php
/**
 * @author JKetelaar
 */

require_once('../vendor/autoload.php');

define('DATA_DIR', (($dir = drush_server_home()) === null ? __DIR__ : $dir) . '/.fut-bot/data/');

$creds = [
    'username' => 'my@email.com',
    'password' => 'my_password',
    'secret'   => 'my_secret_answer',
    'key'      => 'key_generator_function_name',
    'platform' => 'ps4',
];

$api = new \JKetelaar\fut\api\API(
    $creds[ 'username' ], $creds[ 'password' ], $creds[ 'secret' ], $creds[ 'key' ], $creds[ 'platform' ]
);

function key_generator_function_name() {
    $totp = new \OTPHP\TOTP('FIFA', 'KXVY7VWMX2IMLDIM');

    return $totp->now();
}

/**
 * @return null|string
 */
function drush_server_home() {
    $home = getenv('HOME');
    if( !empty($home)) {
        $home = rtrim($home, '/');
    } elseif( !empty($_SERVER[ 'HOMEDRIVE' ]) && !empty($_SERVER[ 'HOMEPATH' ])) {
        $home = $_SERVER[ 'HOMEDRIVE' ] . $_SERVER[ 'HOMEPATH' ];
        $home = rtrim($home, '\\/');
    }

    return empty($home) ? null : $home;
}