<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\trading;

use MyCLabs\Enum\Enum;

class TradeState extends Enum {

    const ACTIVE = 'active';
    const EXPIRED = 'expired';
    const NONE = null;
    const _DEFAULT = self::NONE;

    /**
     * @param      $value
     *
     * @param bool $returnObject
     *
     * @return TradeState
     */
    public static function findByValue($value, $returnObject = false){
        foreach(self::values() as $item){
            if (strtolower($item->getKey()) === strtolower($value)){
                return $returnObject ? $item : $item->getValue();
            }
        }
        return $returnObject ? self::_DEFAULT : self::_DEFAULT()->getValue();
    }
}