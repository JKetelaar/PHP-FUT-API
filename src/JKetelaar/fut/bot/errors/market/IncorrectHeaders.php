<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors\market;

class IncorrectHeaders extends \Exception {
    /**
     * IncorrectHeaders constructor.
     */
    public function __construct() {
        parent::__construct('Headers parameter should either be null or have associative keys');
    }
}