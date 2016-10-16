<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors\login;

class MainLogin extends BaseLoginException {
    /**
     * MainLogin constructor.
     *
     * @param string $errorCode
     * @param string $message
     */
    public function __construct($errorCode, $message = null) {
        parent::__construct(
            'Unable to login with unknown response' . ($message != null ? "\n" . 'With the following message: ' . $message : ''),
            $errorCode
        );
    }
}