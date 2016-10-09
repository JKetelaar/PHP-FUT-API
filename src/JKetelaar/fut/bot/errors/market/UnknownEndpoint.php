<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors\market;

use Exception;

class UnknownEndpoint extends \Exception {
    public function __construct($endpoint) {
        parent::__construct(
            'Endpoint given is unknown: ' . $endpoint
        );
    }

}