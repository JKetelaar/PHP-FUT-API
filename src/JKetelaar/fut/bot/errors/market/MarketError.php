<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors\market;

class MarketError extends \Exception {
    /**
     * MarketError constructor.
     *
     * @param string|null $message
     * @param string|null $code
     * @param string|null $response
     */
    public function __construct($message = null, $code = null, $response = null) {
        if($message == null) {
            $message = 'Unknown error occurred in the Market. If this error is unknown to you too, please report this error.';
        }

        if($code != null) {
            $message .= "\nError with code: " . $code;
        }

        if($response != null) {
            $message .= "\nWith response message:" . $response;
        }

        parent::__construct($message);
    }
}