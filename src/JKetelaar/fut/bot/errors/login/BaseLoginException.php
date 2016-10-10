<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors\login;

class BaseLoginException extends \Exception {
    /**
     * BaseLoginException constructor.
     *
     * @param $message
     * @param $errorCode
     */
    public function __construct($message, $errorCode) {
        parent::__construct($message . "\n" . 'With error code: ' . $errorCode);
    }
}