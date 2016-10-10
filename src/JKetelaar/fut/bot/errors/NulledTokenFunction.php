<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors;

class NulledTokenFunction extends \Exception {
    /**
     * NulledTokenFunction constructor.
     */
    public function __construct() {
        parent::__construct('Token function gave a null value');
    }
}