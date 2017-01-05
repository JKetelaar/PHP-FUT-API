<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\errors\market;

class UnknownEndpoint extends \Exception {
    public function __construct($endpoint) {
        parent::__construct(
            'Endpoint given is unknown: ' . $endpoint
        );
    }
}