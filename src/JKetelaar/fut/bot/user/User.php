<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\user;

use JKetelaar\fut\bot\errors\NonExistingTokenFunction;
use JKetelaar\fut\bot\errors\NulledTokenFunction;

class User {

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $tokenFunction;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $platform;

    /**
     * @var
     */
    private $headers;

    /**
     * User constructor.
     *
     * @param string $username
     * @param string $password
     * @param string $secret
     * @param string $tokenFunction
     * @param        $platform
     */
    public function __construct($username, $password, $secret, $tokenFunction, $platform) {
        $this->username      = $username;
        $this->password      = $password;
        $this->secret        = $secret;
        $this->tokenFunction = $tokenFunction;
        $this->platform      = $platform;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSecret() {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getTokenFunction() {
        return $this->tokenFunction;
    }

    /**
     * @return string
     */
    public function getPlatform() {
        return $this->platform;
    }

    public function getCachedToken() {
        return $this->token;
    }

    public function getToken() {
        if(function_exists($this->tokenFunction)) {
            $func = $this->tokenFunction;
            if(($token = $func()) != null) {
                $this->token = $token;

                return $this->token;
            } else {
                throw new NulledTokenFunction();
            }
        } else {
            throw new NonExistingTokenFunction();
        }
    }

    /**
     * @return mixed
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers) {
        $this->headers = $headers;
    }
}