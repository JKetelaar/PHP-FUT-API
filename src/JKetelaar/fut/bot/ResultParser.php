<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot;

interface ResultParser {
    /**
     * @param array $result
     *
     * @return object
     */
    public static function toObject($result);
}