<?php
/**
 * @author JKetelaar
 */

require_once(__DIR__ . '/../vendor/autoload.php');

define('NODE_LOCATION', '/usr/local/bin/node');
define('DATA_DIR', (($dir = drush_server_home()) === null ? __DIR__ : $dir) . '/.fut-bot/data/');

if( !file_exists(DATA_DIR)) {
    mkdir(DATA_DIR, 0777, true);
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