<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot;

use Curl\Curl;
use JKetelaar\fut\bot\errors\NonExistingTokenFunction;
use JKetelaar\fut\bot\errors\UnknownPlatform;
use JKetelaar\fut\bot\market\Handler;
use JKetelaar\fut\bot\user\Login;
use JKetelaar\fut\bot\user\User;

class API {
    /**
     * @var User
     */
    private $user;

    /**
     * @var Login
     */
    private $login;

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var Handler
     */
    private $handler;

    /**
     * API constructor.
     *
     * @param string $username
     * @param string $password
     * @param string $secret
     * @param string $token_function
     * @param string $platform
     *
     * @throws NonExistingTokenFunction
     * @throws UnknownPlatform
     */
    public function __construct($username, $password, $secret, $token_function, $platform) {
        if(self::getPlatform($platform) == null) {
            throw new UnknownPlatform();
        }

        if(function_exists($token_function)) {
            $this->user = new User($username, $password, $secret, $token_function, $platform);
        } else {
            throw new NonExistingTokenFunction();
        }
    }

    public static final function getPlatform($platform) {
        switch($platform) {
            case 'pc':
                return 'pc';
            case 'ps3':
            case 'ps4':
                return 'ps3';
            case 'x360':
            case 'xone':
                return '360';
        }

        return null;
    }

    public static final function getGameSku($platform) {
        switch($platform) {
            case 'pc':
                return 'FFA17PCC';
            case 'ps3':
                return 'FFA17PS3';
            case 'ps4':
                return 'FFA17PS4';
            case 'x360':
                return 'FFA17XBX';
            case 'xone':
                return 'FFA17XBO';
        }

        return null;
    }

    /**
     * @return Handler
     */
    public function getHandler() {
        if(($handler = $this->handler) == null) {
            $this->handler = new Handler($this->curl, $this->user);
        }

        return $this->handler;
    }

    public function login($path = DATA_DIR . '/cookies.txt') {
        if($this->login == null) {
            $this->login = new Login($this->user, $path);
        }

        if(($result = $this->login->login()) === true) {
            $this->curl = $this->login->getCurl();
        }

        return $result;
    }
}