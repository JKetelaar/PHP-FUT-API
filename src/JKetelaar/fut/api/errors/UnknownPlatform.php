<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors;

class UnknownPlatform extends \Exception {
    /**
     * UnknownPlatform constructor.
     */
    public function __construct() {
        parent::__construct('Platform provided is unknown');
    }
}