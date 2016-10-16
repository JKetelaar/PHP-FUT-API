<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\items\players\attributes;

use JKetelaar\fut\bot\ImprovedEnum;

class Attribute extends ImprovedEnum {

    const PACE      = 0;
    const SHOOTING  = 1;
    const PASSING   = 2;
    const DRIBBLING = 3;
    const DEFENDING = 4;
    const PHYSICAL  = 5;

    /**
     * @param string $value
     * @param bool   $returnObject
     * @param null   $default
     *
     * @return Attribute|null
     */
    public static function findByValue($value, $returnObject = false, $default = null) {
        /* @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::findByValue($value, $returnObject, $default);
    }
}