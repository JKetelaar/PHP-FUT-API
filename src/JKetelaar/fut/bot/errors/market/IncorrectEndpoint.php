<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\errors\market;

class IncorrectEndpoint extends \Exception {
    /**
     * IncorrectEndpoint constructor.
     *
     * @param string $url
     */
    public function __construct($url) {
        parent::__construct('Incorrect url given, should be without host. Path only; ' . $url);
    }
}