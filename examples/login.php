<?php
/**
 * @author JKetelaar
 */

require_once('bootstrap.php');

if($api->login() === true) {
    echo('We\'re logged in!');
}