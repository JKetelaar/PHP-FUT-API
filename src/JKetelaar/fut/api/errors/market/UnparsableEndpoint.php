<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\errors\market;

class UnparsableEndpoint extends \Exception {
    /**
     * UnparsableEndpoint constructor.
     */
    public function __construct($url) {
        parent::__construct('Could not parse given path with the host; ' . $url);
    }
}