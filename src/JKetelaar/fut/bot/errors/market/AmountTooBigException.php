<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors\market;

class AmountTooBigException extends \Exception {
    /**
     * AmountTooBigException constructor.
     *
     * @param int $requested
     * @param int $max
     */
    public function __construct($requested, $max) {
        parent::__construct('You requested an amount of ' . $requested . ', though the limit is ' . $max);
    }
}