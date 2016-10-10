<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors;

class CaptchaException extends \Exception {
    /**
     * CaptchaException constructor.
     */
    public function __construct() {
        parent::__construct('Your account received a captcha, unfortunately a solution is not yet implemented');
    }
}