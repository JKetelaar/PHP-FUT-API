<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api;

interface ResultParser {
    /**
     * @param array $result
     *
     * @return object
     */
    public static function toObject($result);
}